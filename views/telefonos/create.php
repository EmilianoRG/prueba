<?php

use app\models\cliente\Cliente;
use app\models\telefono\Telefono;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var Telefono $model */
/** @var Cliente $cliente */

$this->title = 'Agregar Teléfono al Cliente: ' . $cliente->getNombreCompleto();
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['clientes/index']];
$this->params['breadcrumbs'][] = ['label' => $cliente->getNombreCompleto(), 'url' => ['clientes/view', 'id' => $cliente->id]];
$this->params['breadcrumbs'][] = 'Nuevo Teléfono';
?>

<h1><?= Html::encode($this->title) ?></h1>

<?= $this->render('_form', [
  'model' => $model,
]) ?>

