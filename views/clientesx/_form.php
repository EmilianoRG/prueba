<?php
use app\models\cliente\Cliente;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\web\View;

/** @var View $this */
/** @var Cliente $model */

$form = ActiveForm::begin([
  'enableAjaxValidation' => false,
  'enableClientScript' => false,
  'options' => ['autocomplete' => 'off']
]);

echo $form->field($model, 'nombre')->textInput();

echo $form->field($model, 'apellido_paterno')->textInput();

echo $form->field($model, 'apellido_materno')->textInput();

echo $form->field($model, 'edad')->textInput();

echo $form->field($model, 'correo')->textInput();

echo $form->field($model, 'domicilio')->textarea();

echo Html::submitButton(
  $model->id === null ? 'Crear Cliente' : 'Guardar Cambios',
  ['class' => 'btn btn-primary']
);

ActiveForm::end();