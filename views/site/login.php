<?php
use app\models\LoginForm;
use yii\helpers\Html;
use yii\web\View;

/** @var View $this */
/** @var LoginForm $model */

$this->title = 'Iniciar Sesión';
?>
<div class="row">
  <div class="col-md-4 offset-md-4">
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_loginForm', ['model' => $model]) ?>
  </div>
</div>