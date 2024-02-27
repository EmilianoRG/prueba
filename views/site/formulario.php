<?php
use app\models\Cliente;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\web\View;

/** @var View $this */
/** @var Cliente $model */

if (Yii::$app->session->hasFlash('enviado')) {
  echo '<div class="alert alert-success" role="alert">' . Yii::$app->session->getFlash('enviado') . '</div>';
}

$form = ActiveForm::begin([
  'enableAjaxValidation' => false,
  'enableClientScript' => false,
  'options' => ['autocomplete' => 'off']
]);

echo $form->field($model, 'nombre')->textInput();

echo $form->field($model, 'edad')->textInput();

echo $form->field($model, 'correo')->textInput();

echo $form->field($model, 'domicilio')->textarea();

echo Html::submitButton('Enviar Datos', ['class' => 'btn btn-primary']);

ActiveForm::end();
?>

