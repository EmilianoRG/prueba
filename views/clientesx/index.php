<?php
use app\models\cliente\Cliente;
use yii\bootstrap5\Html;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\web\View;

/** @var View $this */
/** @var Cliente[] $clientes */
/** @var ActiveDataProvider $dataProvider */

$this->title = 'Clientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Clientes</h1>
<?= Html::a('Nuevo Cliente', ['clientes/create'], ['class' => 'btn btn-primary']) ?>
<?php
echo GridView::widget([
  'dataProvider' => $dataProvider,
  'columns' => [
//    'nombre',
    [
      'format' => 'raw',
      'attribute' => 'nombre',
      'content' => fn (Cliente $cliente) => '<strong>' . $cliente->getNombreCompleto() . '</strong>'
    ],
//    'apellido_paterno',
//    'apellido_materno',
    'correo',
    'edad',
    ['class' => 'yii\grid\ActionColumn'],
  ],
]);
?>