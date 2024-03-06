<?php
namespace app\models\clientex;

use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $nombre
 * @property string $apellido_paterno
 * @property string $apellido_materno
 * @property string $correo
 * @property int $edad
 * @property string $domicilio
 * @property int $status
 */
class ClienteX extends ActiveRecord {
  public static function tableName(): string {
    return 'clientes';
  }

  public function rules(): array {
    return [
      [['nombre', 'apellido_paterno', 'apellido_materno', 'edad', 'correo'], 'required'],
      [['nombre', 'apellido_paterno', 'apellido_materno', 'correo', 'domicilio'], 'string', 'max' => 50],
      [['correo'], 'email'],
      [['edad'], 'integer', 'min' => 18],
//      [['status'], 'integer'],
      [['status'], 'boolean', 'trueValue' => true, 'falseValue' => false]
    ];
  }

  public function attributeLabels(): array {
    return [
      'id' => 'ID',
      'nombre' => 'Nombre Completo',
      'apellido_paterno' => 'Apellido Paterno',
      'apellido_materno' => 'Apellido Materno',
      'edad' => 'Edad',
      'correo' => 'Correo',
      'domicilio' => 'Domicilio',
      'status' => 'Status'
    ];
  }

  public function getNombreCompleto(): string {
    return $this->nombre . ' ' . $this->apellido_paterno . ' ' . $this->apellido_materno;
  }
}