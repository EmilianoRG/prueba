<?php
use kartik\helpers\Html;
use yii\web\View;

/** @var View $this */

$buttons = [
  Html::a('Enviar Correo', ['test/send-email'], ['class' => 'btn btn-primary']),
  Html::a('Descargar PDF', ['test/download-pdf'], ['class' => 'btn btn-danger']),
  Html::a('Subir Archivo', ['test/upload-file'], ['class' => 'btn btn-dark']),
];
echo Html::tag(
  'div',
  implode('', $buttons),
  [
    'style' => [
      'display' => 'grid',
      'grid-template-columns' => 'repeat(6, 1fr)',
      'gap' => '8px'
    ]
  ]
);