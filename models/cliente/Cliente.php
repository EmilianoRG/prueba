<?php

namespace app\models\cliente;

use Yii;

/**
 * This is the model class for table "clientes".
 *
 * @property int $id
 * @property string $nombre
 * @property string $apellido_paterno
 * @property string $apellido_materno
 * @property string $correo
 * @property int $edad
 * @property string|null $domicilio
 * @property int $status
 *
 * @property Ordenes[] $ordenes
 * @property Telefonos[] $telefonos
 */
class Cliente extends \yii\db\ActiveRecord {
  /**
   * {@inheritdoc}
   */
  public static function tableName() {
    return 'clientes';
  }

  /**
   * {@inheritdoc}
   */
  public function rules() {
    return [
      [['nombre', 'apellido_paterno', 'apellido_materno', 'correo', 'edad'], 'required'],
      [['edad', 'status'], 'integer'],
      [['domicilio'], 'string'],
      [['nombre', 'apellido_paterno', 'apellido_materno', 'correo'], 'string', 'max' => 50],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels() {
    return [
      'id' => 'ID',
      'nombre' => 'Nombre',
      'apellido_paterno' => 'Apellido Paterno',
      'apellido_materno' => 'Apellido Materno',
      'correo' => 'Correo',
      'edad' => 'Edad',
      'domicilio' => 'Domicilio',
      'status' => 'Status',
    ];
  }

  /**
   * Gets query for [[Ordenes]].
   *
   * @return \yii\db\ActiveQuery
   */
  public function getOrdenes() {
    return $this->hasMany(Ordenes::class, ['cliente_id' => 'id']);
  }

  /**
   * Gets query for [[Telefonos]].
   *
   * @return \yii\db\ActiveQuery
   */
  public function getTelefonos() {
    return $this->hasMany(Telefonos::class, ['cliente_id' => 'id']);
  }

  public function ajustarCampos() {
    $this->nombre = mb_strtoupper(trim($this->nombre), 'utf-8');
    $this->apellido_paterno = mb_strtoupper(trim($this->apellido_paterno), 'utf-8');
    $this->apellido_materno = mb_strtoupper(trim($this->apellido_materno), 'utf-8');
    $this->domicilio = mb_strtoupper(trim($this->domicilio), 'utf-8');
  }

  public function getNombreCompleto(): string {
    return $this->nombre . ' ' . $this->apellido_paterno . ' ' . $this->apellido_materno;
  }
}
