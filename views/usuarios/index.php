<?php
use app\models\usuario\Usuario;
use app\models\usuario\UsuarioSearch;
use kartik\grid\GridView;
use kartik\helpers\Html;
use yii\data\ActiveDataProvider;
use yii\web\View;

/** @var View $this */
/** @var UsuarioSearch $searchModel */
/** @var ActiveDataProvider $dataProvider */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<p>
  <?= Html::a('Nuevo Usuario', ['create'], ['class' => 'btn btn-success']) ?>
</p>
<?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<?= GridView::widget([
  'dataProvider' => $dataProvider,
  'filterModel' => $searchModel,
  'id' => 'usuarios-gridview',
  'responsive' => true,
  'hover' => true,
  'pjax' => true,
  'pjaxSettings' => [
    'neverTimeout' => true,
    'options' => ['id' => "usuarios-gridview-pjax"]
  ],
  'columns' => [
    'nombre',
    'usuario',
    'rol',
    [
      'format' => 'raw',
      'content' => function (Usuario $usuario) {
        $buttons = [
          Html::a(
            '<i class="fa-solid fa-magnifying-glass"></i>',
            ['usuarios/view', 'id' => $usuario->id],
            [
              'class' => 'btn btn-primary',
              'data-pjax' => 0
            ]
          )
        ];
        if ($usuario->id !== 1) {
          $buttons[] = Html::a(
            Html::icon('pencil', [], 'fas fa-'),
            ['usuarios/update', 'id' => $usuario->id],
            [
              'class' => 'btn btn-dark',
              'data-pjax' => 0
            ]
          );
          $buttons[] = Html::a(
            Html::icon('trash', [], 'fas fa-'),
            ['usuarios/delete', 'id' => $usuario->id],
            [
              'class' => 'btn btn-danger',
              'data' => [
                'method' => 'post',
                'confirm' => '¿Desea eliminar este registro?'
              ]
            ]
          );
        }
        return Html::tag('div', implode('', $buttons), ['class' => 'buttons']);
      }
    ]
  ]
]); ?>
