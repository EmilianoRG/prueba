<?php

use app\models\cliente\Cliente;
use kartik\grid\GridView;
use kartik\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\cliente\ClienteSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Clientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>

<p>
  <?= Html::a('Nuevo Cliente', ['create'], ['class' => 'btn btn-success']) ?>
</p>

<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?= GridView::widget([
  'dataProvider' => $dataProvider,
  'filterModel' => $searchModel,
  'id' => 'clientes-gridview',
  'responsive' => true,
  'hover' => true,
  'pjax' => true,
  'pjaxSettings' => [
    'neverTimeout' => true,
    'options' => ['id' => "clientes-gridview-pjax"]
  ],
  'columns' => [
    'nombre',
    'apellido_paterno',
    'apellido_materno',
    'correo',
    'edad',
    //'domicilio:ntext',
    //'status',
    [
      'format' => 'raw',
      'content' => function (Cliente $cliente) {
        $buttons = [
          Html::a(
            '<i class="fa-solid fa-magnifying-glass"></i>',
            ['clientes/view', 'id' => $cliente->id],
            [
              'class' => 'btn btn-primary',
              'data-pjax' => 0
            ]
          ),
          Html::a(
            Html::icon('pencil', [], 'fas fa-'),
            ['clientes/update', 'id' => $cliente->id],
            [
              'class' => 'btn btn-dark',
              'data-pjax' => 0
            ]
          ),
          Html::a(
            Html::icon('trash', [], 'fas fa-'),
            ['clientes/delete', 'id' => $cliente->id],
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
