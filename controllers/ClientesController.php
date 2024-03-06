<?php
namespace app\controllers;

use app\models\cliente\Cliente;
use app\models\cliente\ClienteSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClientesController implements the CRUD actions for Cliente model.
 */
class ClientesController extends Controller {
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

  protected function findModel($id) {
    if (($model = Cliente::findOne(['id' => $id, 'status' => true])) !== null) {
      return $model;
    }
    throw new NotFoundHttpException('La página solicitada no existe.');
  }

  public function actionIndex() {
    $searchModel = new ClienteSearch();
    $dataProvider = $searchModel->search($this->request->queryParams);
    return $this->render('index', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
    ]);
  }

  public function actionView($id) {
    return $this->render('view', [
      'model' => $this->findModel($id),
    ]);
  }

  public function actionCreate() {
    $model = new Cliente();
    if ($this->request->isPost && $model->load($this->request->post())) {
      $model->ajustarCampos();
      if ($model->save()) {
        return $this->redirect(['view', 'id' => $model->id]);
      }
    }
    return $this->render('create', [
      'model' => $model,
    ]);
  }

  public function actionUpdate($id) {
    $model = $this->findModel($id);

    if ($this->request->isPost && $model->load($this->request->post())) {
      $model->ajustarCampos();
      if ($model->save()) {
        return $this->redirect(['view', 'id' => $model->id]);
      }
    }

    return $this->render('update', [
      'model' => $model,
    ]);
  }

  public function actionDelete($id) {
    $model = $this->findModel($id);
    $model->status = false;
    if (!$model->save()) {
      throw new HttpException(500, 'Ocurrió un problema al intentar eliminar el cliente: ' . $model->getNombreCompleto());
    }
    return $this->redirect(['index']);
  }
}
