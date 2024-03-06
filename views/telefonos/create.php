<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\telefono\Telefono $model */

$this->title = 'Create Telefono';
$this->params['breadcrumbs'][] = ['label' => 'Telefonos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="telefono-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
