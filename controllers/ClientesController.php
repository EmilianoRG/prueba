<?php
namespace app\controllers;

use app\models\cliente\Cliente;
use Yii;
use yii\web\Controller;

class ClientesController extends Controller {
  public function actionIndex() {
    $clientes = Cliente::find()->where(['status' => true])->all();

    return $this->render('index', [
      'clientes' => $clientes
    ]);
  }

  public function actionCreate() {
    $model = new Cliente();
    if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->id]);
    }
    return $this->render('create', ['model' => $model]);
  }
}