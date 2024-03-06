<?php

use app\models\telefono\Telefono;
use kartik\widgets\ActiveForm;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var Telefono $model */

/** @var kartik\widgets\ActiveForm $form */
$form = ActiveForm::begin([
  'enableAjaxValidation' => false,
  'enableClientScript' => false,
  'options' => ['autocomplete' => 'off']
]);

$numeroTextInput = $form->field($model, 'numero')->textInput(['maxlength' => 10]);

$submitButton = Html::submitButton(
  $model->id === null ? 'Agregar Teléfono' : 'Guardar Cambios',
  ['class' => 'btn btn-primary']
);
?>
<div class="row">
  <div class="col-md-12">
    <?= $numeroTextInput ?>
  </div>
</div>
<?= $submitButton ?>
<?php ActiveForm::end(); ?>