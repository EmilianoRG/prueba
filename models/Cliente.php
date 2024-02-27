<?php
namespace app\models;

use yii\base\Model;

class Cliente extends Model {
  public $nombre;
  public $edad;
  public $correo;
  public $domicilio;

  public function rules(): array {
    return [
      [['nombre', 'edad', 'correo'], 'required'],
      [['nombre', 'domicilio'], 'string'],
      [['correo'], 'email'],
      [['edad'], 'integer']
    ];
  }

  public function attributeLabels(): array {
    return [
      'nombre' => 'Nombre Completo',
      'edad' => 'Edad',
      'correo' => 'Correo',
      'domicilio' => 'Domicilio',
    ];
  }
}