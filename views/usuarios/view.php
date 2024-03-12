<?php
use app\models\usuario\Usuario;
use kartik\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

/** @var View $this */
/** @var Usuario $model */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<p>
  <?php
  if ($model->id !== 1) {
    echo Html::a(
      Html::icon('pencil', [], 'fas fa-') . ' Modificar',
      ['update', 'id' => $model->id],
      ['class' => 'btn btn-primary']
    );
    echo Html::a(
      Html::icon('trash', [], 'fas fa-') . ' Eliminar',
      ['delete', 'id' => $model->id],
      [
        'class' => 'btn btn-danger',
        'data' => [
          'confirm' => '¿Desea eliminar este usuario?',
          'method' => 'post'
        ]
      ]
    );
  }
  ?>
</p>
<?= DetailView::widget([
  'model' => $model,
  'attributes' => [
    'nombre',
    'usuario',
    'rol'
  ]
]) ?>