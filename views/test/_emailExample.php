<?php
use yii\helpers\Url;
use yii\web\View;

/** @var View $this */
/** @var string $title */

// NOTA: Los estilos para correo son MUY LIMITADOS!! e incluso no todos los servicios de correo muestran
// los estilos de la misma forma, por ejemplo Gmail no permite usar la etiqueta <style></style>
$fontFamily = "font-family: 'Montserrat', Arial, sans-serif;";
$textColor = '#666';

$body = 'background-color: #f3f3f3; padding: 16px;';
$container = 'width: 400px; margin: auto; padding: 32px 0;';
$logo = 'height: 100px;';
$title = "{$fontFamily} font-size: 20px; text-align: center; letter-spacing: 1px; color: black; margin: 24px 0; font-weight: bold;";
$p = "{$fontFamily} color: {$textColor}; font-size: 12px; margin-bottom: 16px; text-align: justify;";
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $title ?></title>
</head>
<body style="<?= $body ?>">
  <div style="<?= $container ?>">
<!--    las imagenes siempre deben ser externas y con certificado https-->
    <div align="center">
      <img src="https://i.imgur.com/JEBwKZE.png" alt="logo" style="<?= $logo ?>">
    </div>
    <div style="<?= $title ?>">¡Gracias por registrarse!</div>
    <p style="<?= $p ?>">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci autem dolor doloribus eius neque nisi provident? Atque, consequatur deserunt dicta doloribus, earum excepturi maxime nihil pariatur porro praesentium recusandae ut!</p>
  </div>
</body>
</html>