<?php
namespace app\controllers;

use app\components\Util;
use app\models\auth\AuthAssignment;
use app\models\auth\AuthItem;
use app\models\usuario\Usuario;
use app\models\usuario\UsuarioSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

class UsuariosController extends Controller {
  public function behaviors(): array {
    return array_merge(parent::behaviors(), [
      'access' => [
        'class' => AccessControl::class,
        'rules' => [
          [
            'allow' => true,
            'actions' => [
              'index',
              'view',
              'create',
              'update',
              'delete'
            ],
            'roles' => ['ADMINISTRADOR']
          ]
        ]
      ],
      'verbs' => [
        'class' => VerbFilter::class,
        'actions' => [
          'delete' => ['POST']
        ]
      ],
    ]);
  }

  protected function findModel($id): ?Usuario {
    if (($model = Usuario::findOne(['id' => $id, 'status' => true])) !== null) {
      return $model;
    }
    throw new NotFoundHttpException('La página solicitada no existe');
  }

  public function actionIndex(): string {
    $searchModel = new UsuarioSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    return $this->render('index', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider
    ]);
  }

  public function actionView($id): string {
    return $this->render('view', ['model' => $this->findModel($id)]);
  }

  public function actionCreate() {
    $model = new Usuario();
    $model->rol = Util::ROL_ADMINISTRADOR;
    $model->scenario = 'create';
    $model->validarConfirmacionPassword = true;
    if ($model->load(Yii::$app->request->post())) {
      $passwordIngresado = $model->password; // legible
      $transaction = Yii::$app->db->beginTransaction();
      try {
        // <editor-fold defaultstate="collapsed" desc="Crear Usuario">

        // primero validar, luego hashear y por ultimo guardar el usuario
        if (!$model->validate()) {
          throw new \Exception('Ocurrió un problema al intentar crear el usuario');
        }
        $model->password = password_hash($model->password, PASSWORD_DEFAULT);
        if (!$model->save(false)) {
          throw new \Exception('Ocurrió un problema al intentar crear el usuario');
        }

        // </editor-fold>

        // <editor-fold defaultstate="collapsed" desc="Asignar Rol">

        $rolAuthItem = AuthItem::find()->where(['name' => $model->rol, 'type' => Util::TYPE_ROLE])->one();
        if (!$rolAuthItem) {
          throw new \Exception("No existe el rol con el identificador: **{$model->rol}**", 404);
        }
        $authAssignment = new AuthAssignment();
        $authAssignment->item_name = $rolAuthItem->name;
        $authAssignment->user_id = (string)$model->id;
        if (!$authAssignment->save()) {
          throw new \Exception("Ocurrió un problema al intentar asignar el rol: **{$rolAuthItem->name}** al usuario: **{$model->nombre}**");
        }
        
        // </editor-fold>

        $transaction->commit();
        return $this->redirect(['view', 'id' => $model->id]);
      } catch (\Exception $ex) {
        $transaction->rollBack();
        $model->password = $passwordIngresado; // tambien se podria asignar en blanco al igual que confimarPassword
        $model->errorMessage = $ex->getMessage();
      }
    }
    return $this->render('create', ['model' => $model]);
  }

  public function actionUpdate($id) {
    $model = $this->findModel($id);
    if ($model->id === 1) {
      throw new ForbiddenHttpException('No se puede modificar el usuario default');
    }
    $hashedPassword = $model->password; // password hasheado guardado
    $model->password = ''; // vacio
    $model->confirmarPassword = ''; // vacio
    $rolOriginal = $model->rol;
    if ($model->load(Yii::$app->request->post()) && $model->save()) {
      $passwordIngresado = $model->password; // legible (puede estar vacio)
      $transaction = Yii::$app->db->beginTransaction();
      try {
        // <editor-fold defaultstate="collapsed" desc="Actualizar Usuario">

        if ($model->password || $model->confirmarPassword) {
          $model->validarConfirmacionPassword = true;
        }
        if (!$model->validate()) {
          throw new \Exception('Ocurrió un problema al intentar modificar el usuario');
        }
        if ($model->validarConfirmacionPassword) {
          $model->password = password_hash($model->password, PASSWORD_DEFAULT);
        } else {
          $model->password = $hashedPassword;
        }
        if (!$model->save(false)) {
          throw new \Exception('Ocurrió un problema al intentar modificar el usuario');
        }

        // </editor-fold>

        // <editor-fold defaultstate="collapsed" desc="Asignar Rol (en caso de cambiar)">

        if ($model->rol !== $rolOriginal) {
          $rolAuthItem = AuthItem::find()->where(['name' => $model->rol, 'type' => Util::TYPE_ROLE])->one();
          if (!$rolAuthItem) {
            throw new \Exception("No existe el rol con el identificador: **{$model->rol}**");
          }
          $authAssignment = AuthAssignment::findOne(['user_id' => (string)$model->id]);
          if (!$authAssignment) {
            throw new \Exception("No se encontró el rol del usuario: **{$model->usuario}**");
          }
          $authAssignment->item_name = $rolAuthItem->name;
          if (!$authAssignment->save()) {
            throw new \Exception("Ocurrió un problema al intentar actualizar el rol del usuario: **{$model->usuario}** al nuevo rol: **{$rolAuthItem->name}**");
          }
        }

        // </editor-fold>

        $transaction->commit();
        return $this->redirect(['view', 'id' => $model->id]);
      } catch (\Exception $ex) {
        $transaction->rollBack();
        $model->errorMessage = $ex->getMessage();
        $model->password = $passwordIngresado; // tambien se podria asignar en blanco al igual que confimarPassword
      }
    }
    return $this->render('update', ['model' => $model]);
  }

  public function actionDelete($id): Response {
    $model = $this->findModel($id);
    if ($model->id === 1) {
      throw new ForbiddenHttpException('No se puede eliminar el usuario default');
    }
    $model->status = false;
    if (!$model->save()) {
      throw new HttpException(500, 'Ocurrió un problema al intentar eliminar el usuario: ' . $model->nombre);
    }
    return $this->redirect(['index']);
  }
}
