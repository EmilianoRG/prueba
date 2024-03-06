<?php

namespace app\controllers;

use app\models\cliente\Cliente;
use app\models\telefono\Telefono;
use app\models\telefono\TelefonoSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TelefonosController implements the CRUD actions for Telefono model.
 */
class TelefonosController extends Controller {
  /**
   * @inheritDoc
   */
  public function behaviors() {
    return array_merge(
      parent::behaviors(),
      [
        'verbs' => [
          'class' => VerbFilter::className(),
          'actions' => [
            'delete' => ['POST'],
          ],
        ],
      ]
    );
  }

  /**
   * Lists all Telefono models.
   *
   * @return string
   */
  public function actionIndex() {
    $searchModel = new TelefonoSearch();
    $dataProvider = $searchModel->search($this->request->queryParams);

    return $this->render('index', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
    ]);
  }

  /**
   * Creates a new Telefono model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return string|\yii\web\Response
   */
  public function actionCreate($clienteId) {
    $cliente = Cliente::findOne(['id' => $clienteId, 'status' => true]);
    if (!$cliente) {
      throw new NotFoundHttpException('No existe el cliente');
    }
    $model = new Telefono();
    $model->cliente_id = $cliente->id;
    if ($model->load($this->request->post()) && $model->save()) {
      return $this->redirect(['clientes/view', 'id' => $cliente->id]);
    }
    return $this->render('create', [
      'model' => $model,
      'cliente' => $cliente
    ]);
  }

  /**
   * Updates an existing Telefono model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param int $id ID
   * @return string|\yii\web\Response
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionUpdate($id) {
    $model = $this->findModel($id);
    if ($model->load($this->request->post()) && $model->save()) {
      return $this->redirect(['clientes/view', 'id' => $model->cliente_id]);
    }
    return $this->render('update', [
      'model' => $model,
    ]);
  }

  /**
   * Deletes an existing Telefono model.
   * If deletion is successful, the browser will be redirected to the 'index' page.
   * @param int $id ID
   * @return \yii\web\Response
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionDelete($id) {
    $model = $this->findModel($id);
    $model->status = 0;
    if (!$model->save()) {
      throw new HttpException(500, 'Ocurrió un problema al intentar eliminar el número: ' . $model->numero . ' del cliente: ' . $model->cliente->getNombreCompleto());
    }
    return $this->redirect(['clientes/view', 'id' => $model->cliente->id]);
  }

  /**
   * Finds the Telefono model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param int $id ID
   * @return Telefono the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id) {
    if (($model = Telefono::findOne(['id' => $id])) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
