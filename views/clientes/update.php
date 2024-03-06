<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\cliente\Cliente $model */

$this->title = 'Modificar Cliente: ' . $model->getNombreCompleto();
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->getNombreCompleto(), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<h1><?= Html::encode($this->title) ?></h1>
<?= $this->render('_form', [
  'model' => $model,
]) ?>
