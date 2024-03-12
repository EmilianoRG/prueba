<?php
use app\models\UploadForm;
use yii\helpers\Html;
use yii\web\View;

/** @var View $this */
/** @var UploadForm $model */

$this->title = 'Subir Archivo';
$this->params['breadcrumbs'][] = ['label' => 'Test', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<?= $this->render('_formUpload', ['model' => $model]) ?>