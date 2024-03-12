<?php
use app\models\UploadForm;
use kartik\widgets\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/** @var View $this */
/** @var UploadForm $model */

/** @var ActiveForm $form */
$form = ActiveForm::begin([
  'enableAjaxValidation' => false,
  'enableClientScript' => false,
  'options' => [
    'autocomplete' => 'off',
    'enctype' => 'multipart/form-data' // MUY IMPORTATE PARA SUBIR ARCHIVOS!
  ]
]);

echo $form->field($model, 'imageFile')->fileInput();

echo Html::submitButton('Subir Archivo', ['class' => 'btn btn-primary']);

ActiveForm::end();