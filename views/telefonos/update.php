<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\telefono\Telefono $model */

$this->title = 'Modificar Teléfono: ' . $model->numero;
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['clientes/index']];
$this->params['breadcrumbs'][] = ['label' => $model->cliente->getNombreCompleto(), 'url' => ['clientes/view', 'id' => $model->cliente->id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>

<h1><?= Html::encode($this->title) ?></h1>

<?= $this->render('_form', [
  'model' => $model,
]) ?>

