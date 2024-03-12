<?php
use app\models\LoginForm;
use kartik\widgets\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/** @var View $this */
/** @var LoginForm $model */

/** @var ActiveForm $form */
$form = ActiveForm::begin([
  'enableAjaxValidation' => false,
  'enableClientValidation' => false,
  'options' => ['autocomplete' => 'off']
]);

echo $form->field($model, 'email')->textInput();

echo $form->field($model, 'password')->passwordInput();

echo $form->field($model, 'rememberMe')->checkbox();

echo Html::submitButton('Iniciar Sesión', ['class' => 'btn btn-primary btn-block']);

ActiveForm::end();