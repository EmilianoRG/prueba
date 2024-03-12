<?php
use app\components\Util;
use app\models\usuario\Usuario;
use kartik\widgets\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/** @var View $this */
/** @var Usuario $model */

/** @var ActiveForm $form */
$form = ActiveForm::begin([
  'enableAjaxValidation' => false,
  'enableClientScript' => false,
  'options' => ['autocomplete' => 'off']
]);

$nombreTextInput = $form->field($model, 'nombre')->textInput(['maxlength' => 64]);

$usuarioTextInput = $form->field($model, 'usuario')->textInput(['maxlength' => 64]);

$passwordInput = $form->field($model, 'password')->passwordInput(['maxlength' => 64]);

$confirmarPasswordInput = $form->field($model, 'confirmarPassword')->passwordInput(['maxlength' => 64]);

$rolDropDownList = $form->field($model, 'rol')->dropDownList(Util::$rolArray, [
  'disabled' => $model->id === 1,
  'class' => 'form-select'
]);

$submitButton = Html::submitButton(
  $model->id === null ? 'Crear Usuario' : 'Guardar Cambios',
  ['class' => 'btn btn-primary']
);
?>
<div class="row">
  <div class="col-md-6">
    <?= $nombreTextInput ?>
  </div>
  <div class="col-md-6">
    <?= $usuarioTextInput ?>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <?= $passwordInput ?>
  </div>
  <div class="col-md-6">
    <?= $confirmarPasswordInput ?>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <?= $rolDropDownList ?>
  </div>
</div>
<?= $submitButton ?>
<?php ActiveForm::end(); ?>