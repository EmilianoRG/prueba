<?php
use app\models\cliente\Cliente;
use yii\bootstrap5\Html;
use yii\web\View;

/** @var View $this */
/** @var Cliente[] $clientes */

$this->title = 'Clientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Clientes</h1>
<?= Html::a('Nuevo Cliente', ['clientes/create'], ['class' => 'btn btn-primary']) ?>
<ul class="list-group" style="margin-bottom: 16px;">
  <?php foreach ($clientes as $cliente): ?>
    <li class="list-group-item"><?= $cliente->getNombreCompleto() ?></li>
  <?php endforeach; ?>
</ul>
