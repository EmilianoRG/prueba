<?php

use kartik\widgets\ActiveForm;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\cliente\Cliente $model */

/** @var kartik\widgets\ActiveForm $form */
$form = ActiveForm::begin([
  'enableAjaxValidation' => false,
  'enableClientScript' => false,
  'options' => ['autocomplete' => 'off']
]);

$nombreTextInput = $form->field($model, 'nombre')->textInput(['maxlength' => 50]);

$apellidoPaternoTextInput = $form->field($model, 'apellido_paterno')->textInput(['maxlength' => 50]);

$apellidoMaternoTextInput = $form->field($model, 'apellido_materno')->textInput(['maxlength' => 50]);

$correoTextInput = $form->field($model, 'correo')->textInput(['maxlength' => 50]);

$edadTextInput = $form->field($model, 'edad')->textInput();

$domicilioTextArea = $form->field($model, 'domicilio')->textarea(['rows' => 4]);

$submitButton = Html::submitButton(
  $model->id === null ? 'Crear Cliente' : 'Guardar Cambios',
  ['class' => 'btn btn-primary']
);
?>

<div class="row">
  <div class="col-md-4">
    <?= $nombreTextInput ?>
  </div>
  <div class="col-md-4">
    <?= $apellidoPaternoTextInput ?>
  </div>
  <div class="col-md-4">
    <?= $apellidoMaternoTextInput ?>
  </div>
</div>
<div class="row">
  <div class="col-md-4">
    <?= $correoTextInput ?>
  </div>
  <div class="col-md-2">
    <?= $edadTextInput ?>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <?= $domicilioTextArea ?>
  </div>
</div>
<?= $submitButton ?>
<?php ActiveForm::end(); ?>