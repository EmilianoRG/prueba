<?php

use app\models\telefono\Telefono;
use kartik\grid\GridView;
use kartik\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\cliente\Cliente $model */
/** @var app\models\telefono\TelefonoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = $model->getNombreCompleto();
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<p>
  <?= Html::a(
    Html::icon('pencil', [], 'fas fa-') . ' Modificar',
    ['update', 'id' => $model->id],
    ['class' => 'btn btn-primary']
  ) ?>
  <?= Html::a(
    Html::icon('trash', [], 'fas fa-') . ' Eliminar',
    ['delete', 'id' => $model->id],
    [
      'class' => 'btn btn-danger',
      'data' => [
        'confirm' => '¿Desea eliminar este registro?',
        'method' => 'post',
      ],
    ]
  ) ?>
</p>

<?= DetailView::widget([
  'model' => $model,
  'attributes' => [
    [
      'attribute' => 'nombre',
      'value' => $model->getNombreCompleto()
    ],
    'correo',
    'edad',
    'domicilio'
  ],
]) ?>

<h2>Teléfonos</h2>

<?= Html::a(
  Html::icon('plus', [], 'fas fa-') . ' Agregar Teléfono',
  ['telefonos/create', 'clienteId' => $model->id],
  ['class' => 'btn btn-success']
) ?>

<?= GridView::widget([
  'dataProvider' => $dataProvider,
  'filterModel' => $searchModel,
  'id' => 'telefonos-gridview',
  'responsive' => true,
  'hover' => true,
  'pjax' => true,
  'pjaxSettings' => [
    'neverTimeout' => true,
    'options' => ['id' => "telefonos-gridview-pjax"]
  ],
  'columns' => [
    'numero',
    [
      'format' => 'raw',
      'content' => function (Telefono $telefono) {
        $buttons = [
          Html::a(
            Html::icon('pencil', [], 'fas fa-'),
            ['telefonos/update', 'id' => $telefono->id],
            [
              'class' => 'btn btn-dark',
              'data-pjax' => 0
            ]
          ),
          Html::a(
            Html::icon('trash', [], 'fas fa-'),
            ['telefonos/delete', 'id' => $telefono->id],
            [
              'class' => 'btn btn-danger',
              'data' => [
                'method' => 'post',
                'confirm' => '¿Desea eliminar este registro?'
              ]
            ]
          )
        ];
        return Html::tag('div', implode('', $buttons), ['class' => 'buttons']);
      }
    ]
  ]
]); ?>
