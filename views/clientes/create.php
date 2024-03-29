<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\cliente\Cliente $model */

$this->title = 'Nuevo Cliente';
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<?= $this->render('_form', [
  'model' => $model,
]) ?>