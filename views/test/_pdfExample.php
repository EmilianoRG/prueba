<?php
use yii\helpers\Url;
use yii\web\View;

/** @var View $this */
/** @var string $title */
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $title ?></title>
  <style>
    /*Inline Styles*/
    * {
      border: 0;
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, Helvetica, sans-serif;
    }
    h1 {
      text-align: center;
    }
    table {
      width: 100%;
      border-spacing: 0;
      border-collapse: collapse;
    }
    th {
      background: #666;
      color: white;
    }
    th, td {
      text-align: center;
      padding: 5px;
    }
    td.total {
      font-weight: bold;
    }
    tr.resumen td {
      background-color: #b7b7b7;
    }
    tr:nth-child(even) {
      background-color: #f3f3f3;
    }
    tr:nth-child(odd) {
      background-color: #d9d9d9;
    }
    p.mini {
      font-size: 13px;
      color: #444;
    }
    img.test {
      width: 120px;
    }
  </style>
</head>
<body>
  <h1><?= $title ?></h1>
  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque enim molestias unde voluptatibus. Amet, architecto beatae cum dicta dolor maxime molestiae nisi omnis porro praesentium quaerat quos recusandae repellat sed.</p>
  <table>
    <tr>
      <th>Folio</th>
      <th>Cliente</th>
      <th>Fecha</th>
      <th>Total</th>
    </tr>
    <tr>
      <td># 001</td>
      <td>Daniel Morales</td>
      <td>11/Marzo/2024</td>
      <td>$ 1,500.00</td>
    </tr>
    <tr>
      <td># 002</td>
      <td>Miriam Escobedo</td>
      <td>12/Marzo/2024</td>
      <td>$ 3,250.00</td>
    </tr>
    <tr>
      <td># 003</td>
      <td>Alejandro Castillo</td>
      <td>20/Marzo/2024</td>
      <td>$ 2,000.00</td>
    </tr>
    <tr class="resumen">
      <td colspan="3"></td>
      <td class="total">$ 6,750.00</td>
    </tr>
  </table>
  <p class="mini">Lorem ipsum dolor sit amet, consectetur adipisicing elit. At cupiditate deserunt dolorem doloribus dolorum, et fuga incidunt ipsam magnam, necessitatibus odit praesentium quasi sapiente sequi sint unde ut vel veritatis!</p>
  <img class="test" src="https://i.imgur.com/JEBwKZE.png" alt="logo">
<!--  Se puede leer desde el proyecto también-->
  <img src="<?= Url::to('@web/img/logo.png') ?>" alt="image">
</body>
</html>