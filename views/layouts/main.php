<?php

/** @var yii\web\View $this */

/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
  <title><?= Html::encode($this->title) ?></title>
  <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100" style="background-color: #ddd;">
<?php $this->beginBody() ?>

<header id="header">
  <?php
  $items = [
    ['label' => 'Inicio', 'url' => ['site/index']]
  ];
  if (Yii::$app->user->isGuest) { // no ha iniciado sesion
    $items = array_merge($items, [
//      ['label' => 'About', 'url' => ['/site/about']],
//      ['label' => 'Contact', 'url' => ['/site/contact']],
//      ['label' => 'Formulario', 'url' => ['/site/formulario']],
      ['label' => 'Iniciar Sesión', 'url' => ['site/login']]
    ]);
  } else {
    $logoutItem = '<li class="nav-item">'
      . Html::beginForm(['site/logout'])
      . Html::submitButton(
        'Cerrar Sesión',
        ['class' => 'nav-link btn btn-link logout']
      )
      . Html::endForm()
      . '</li>';
    $items = array_merge($items, [
      [
        'label' => 'Clientes',
        'url' => ['clientes/index'],
        'visible' => Yii::$app->user->can('VENTAS')
      ],
      [
        'label' => 'Órdenes',
        'url' => ['ordenes/index'],
        'visible' => Yii::$app->user->can('VENTAS')
      ],
      [
        'label' => 'Servicios',
        'url' => ['servicios/index'],
        'visible' => Yii::$app->user->can('ADMINISTRADOR')
      ],
      [
        'label' => 'Usuarios',
        'url' => ['usuarios/index'],
        'visible' => Yii::$app->user->can('ADMINISTRADOR')
      ],
      $logoutItem
    ]);
  }

  NavBar::begin([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => Yii::$app->homeUrl,
    'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
  ]);
  echo Nav::widget([
    'options' => ['class' => 'navbar-nav'],
    'items' => $items
  ]);
  NavBar::end();
  ?>
</header>

<main id="main" class="flex-shrink-0" role="main" style="flex-grow: 1">
  <div class="container" style="height: 100%">
    <?php if (!empty($this->params['breadcrumbs'])): ?>
      <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
    <?php endif ?>
    <?= Alert::widget() ?>
    <div class="card" style="height: 100%">
      <div class="card-body">
        <?= $content ?>
      </div>
    </div>
  </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
  <div class="container">
    <div class="row text-muted">
      <div class="col-md-6 text-center text-md-start">&copy; My Company <?= date('Y') ?></div>
      <div class="col-md-6 text-center text-md-end"><?= Yii::powered() ?></div>
    </div>
  </div>
</footer>

<script src="https://kit.fontawesome.com/3ffd08a32c.js" crossorigin="anonymous"></script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
