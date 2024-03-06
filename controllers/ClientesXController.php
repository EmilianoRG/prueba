<?php
namespace app\controllers;

use app\models\cliente\Cliente;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;

class ClientesXController extends Controller {
  public function actionIndex() {
    $dataProvider = new ActiveDataProvider([
      'query' => Cliente::find()->where(['status' => true]),
      'pagination' => ['pageSize' => 10],
      'sort' => [
        'defaultOrder' => ['nombre' => SORT_ASC]
      ]
    ]);
    return $this->render('index', [
      'dataProvider' => $dataProvider
    ]);
  }

  public function actionCreate() {
    $model = new Cliente();
    $model->domicilio = 'N/A';
    if ($model->load(Yii::$app->request->post()) && $model->validate()) {
      $model->nombre = mb_strtoupper(trim($model->nombre), 'utf-8');
      $model->apellido_paterno = mb_strtoupper(trim($model->apellido_paterno), 'utf-8');
      $model->apellido_materno = mb_strtoupper(trim($model->apellido_materno), 'utf-8');
      if ($model->save(false)) {
        return $this->redirect(['view', 'id' => $model->id]);
      }
    }
    return $this->render('create', ['model' => $model]);
  }

  public function actionView($id) {
    $model = Cliente::find()->where(['id' => $id, 'status' => true])->one();
    if (!$model) {
      throw new NotFoundHttpException('No se encontró el cliente con Id: ' . $id);
    }
    return $this->render('view', ['model' => $model]);
  }

  public function actionUpdate($id) {
    $model = Cliente::find()->where(['id' => $id, 'status' => true])->one();
    if (!$model) {
      throw new NotFoundHttpException('No se encontró el cliente con Id: ' . $id);
    }
    if ($model->load(Yii::$app->request->post()) && $model->validate()) {
      $model->nombre = mb_strtoupper(trim($model->nombre), 'utf-8');
      $model->apellido_paterno = mb_strtoupper(trim($model->apellido_paterno), 'utf-8');
      $model->apellido_materno = mb_strtoupper(trim($model->apellido_materno), 'utf-8');
      if ($model->save(false)) {
        return $this->redirect(['view', 'id' => $model->id]);
      }
    }
    return $this->render('update', ['model' => $model]);
  }

  public function actionDelete($id) {
    $model = Cliente::find()->where(['id' => $id, 'status' => true])->one();
    if (!$model) {
      throw new NotFoundHttpException('No se encontró el cliente con Id: ' . $id);
    }
    $model->status = false;
    if (!$model->save()) {
      throw new HttpException(500, 'Ocurrió un problema al intentar eliminar el cliente: ' . $model->getNombreCompleto());
    }
    return $this->redirect(['index']);
  }
}