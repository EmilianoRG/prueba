<?php
namespace app\controllers;

use app\models\cliente\Cliente;
use app\models\UploadForm;
use kartik\mpdf\Pdf;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\UploadedFile;

class TestController extends Controller {
  public function actionIndex(): string {
    return $this->render('index');
  }

  public function actionSendEmail(): string {
    // MAS INFO: https://www.yiiframework.com/doc/guide/2.0/en/tutorial-mailing
    $htmlBody = $this->renderPartial('_emailExample', ['title' => 'Prueba']);
    $message = Yii::$app->mailer->compose();
    $message->setFrom('webmaster@chefonline.com.mx');
    $message->setTo([
      'rodriguez.emiliano@2sis.com.mx',
      'emilianodeveloper@gmail.com'
    ]);
    $message->setSubject('Correo de Prueba');
//    $message->setTextBody('Plain text content');
//    $message->setHtmlBody('<b>HTML content</b>');
    $message->setHtmlBody($htmlBody);
    // adjuntar archivos
//    $message->attach(Yii::getAlias('@app/web/files/file.pdf'));
    if ($message->send()) {
      return 'Enviado'; // o redirigir
    }
    return 'Error al enviar correo';
  }

  public function actionDownloadPdf() {
    // MAS INFO KartikPDF: https://demos.krajee.com/mpdf
    // MAS INFO MPDF: https://mpdf.github.io/
    $htmlContent = $this->renderPartial('_pdfExample', ['title' => 'Prueba']);
    $pdf = new Pdf([
      'mode' => Pdf::MODE_UTF8,
      'format' => Pdf::FORMAT_LETTER,
      'orientation' => Pdf::ORIENT_PORTRAIT,
      'destination' => Pdf::DEST_BROWSER,
//      'cssFile' => Yii::getAlias('@app/web/css/custom-pdf.css'),
      'options' => ['title' => 'PDF Example']
    ]);
    $mpdf = $pdf->getApi(); // objeto "mpdf" que usa internamente
    $mpdf->WriteHTML($htmlContent);
    $mpdf->Output('PDF Example.pdf', Pdf::DEST_BROWSER);
  }

  public function actionCreate() {
    $model = new Cliente();
    $errores = [];
    if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
      $transaction = Yii::$app->db->beginTransaction();
      try {
        // <editor-fold defaultstate="collapsed" desc="Cliente">

        $model->ajustarCampos();
        if (!$model->save()) {
          $errores[] = 'Error al intentar crear el cliente';
          // errores extra (opcional)
          foreach ($model->getErrors() as $attribute => $errorData) {
            foreach ($errorData as $error) {
              $errores[] = "{$attribute}: {$error}";
            }
          }
          throw new \Exception('Error al intentar crear el cliente');
        }

        // </editor-fold>

        // <editor-fold defaultstate="collapsed" desc="Usuario">

        $usuario = new Usuario();
        $usuario->nombre = $model->getNombreCompleto();
        $usuario->usuario = $model->nombre . '@test.com';
        $usuario->password = password_hash('12345678', PASSWORD_DEFAULT);
        if (!$usuario->save()) {
          $errores[] = 'Error al intentar crear el usuario';
          // errores extra (opcional)
          foreach ($usuario->getErrors() as $attribute => $errorData) {
            foreach ($errorData as $error) {
              $errores[] = "{$attribute}: {$error}";
            }
          }
          throw new \Exception('Error al intentar crear el usuario');
        }

        // </editor-fold>

        // hasta aqui todo bien, commit y redirigir
        $transaction->commit();
        return $this->redirect(['view', 'id' => $model->id]);
      } catch (\Exception $ex) {
        $transaction->rollBack();
      }
    }
    return $this->render('create', ['model' => $model, 'errores' => $errores]);
  }

  public function actionUploadFile(): string {
    // MAS INFO: https://www.yiiframework.com/doc/guide/2.0/en/input-file-upload
    $model = new UploadForm();
    if ($model->load(Yii::$app->request->post())) {
      $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
      // esta es una funcion util creada almacenar la logica de subir el archvo y reutilizarla
      // sin embargo es solo un ejemplo y la logica se puede escribir aqui directamente
      if ($model->upload()) {
        $src = Url::to('@web/archivos/' . $model->filename);
        return "<img src='$src' alt='foto'>"; // o redirigir
      } else {
        throw new HttpException(500, 'Error al subir el archivo');
      }
    }
    return $this->render('upload', ['model' => $model]);
  }
}