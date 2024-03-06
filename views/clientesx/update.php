<?php
use app\models\cliente\Cliente;
use yii\web\View;

/** @var View $this */
/** @var Cliente $model */

$this->title = 'Modificar Cliente: ' . $model->getNombreCompleto();
$this->params['breadcrumbs'] = [
  ['label' => 'Clientes', 'url' => ['clientes/index']],
  [
    'label' => $model->getNombreCompleto(),
    'url' => ['clientes/view', 'id' => $model->id]
  ],
  $this->title
];
echo '<h1>' . $this->title . '</h1>';
echo $this->render('_form', ['model' => $model]);