<?php
use app\models\cliente\Cliente;
use yii\web\View;
use yii\widgets\DetailView;

/** @var View $this */
/** @var Cliente $model */

$this->title = $model->getNombreCompleto();
$this->params['breadcrumbs'] = [
  ['label' => 'Clientes', 'url' => ['clientes/index']],
  $this->title
];
echo '<h1>' . $this->title . '</h1>';
echo DetailView::widget([
  'model' => $model,
  'attributes' => [
//    'nombre',
//    'apellido_paterno',
//    'apellido_materno',
    [
      'attribute' => 'nombre',
      'value' => $model->getNombreCompleto()
    ],
    'correo',
    'edad',
    'domicilio'
  ],
]);