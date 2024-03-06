<?php
use app\models\cliente\Cliente;
use yii\web\View;

/** @var View $this */
/** @var Cliente $model */

$this->title = 'Nuevo Cliente';
$this->params['breadcrumbs'] = [
  ['label' => 'Clientes', 'url' => ['clientes/index']],
  $this->title
];
echo '<h1>' . $this->title . '</h1>';
echo $this->render('_form', ['model' => $model]);