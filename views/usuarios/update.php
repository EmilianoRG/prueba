<?php
use app\models\usuario\Usuario;
use kartik\helpers\Html;
use yii\web\View;

/** @var View $this */
/** @var Usuario $model */

$this->title = 'Modificar Usuario: ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar Usuario';

if ($model->errorMessage) {
  echo "<div class='alert alert-danger' role='alert'>{$model->errorMessage}</div>";
}
?>
<h1><?= Html::encode($this->title) ?></h1>
<?= $this->render('_form', ['model' => $model]) ?>
