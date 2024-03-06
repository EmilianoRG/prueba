<?php

namespace app\models\telefono;

use app\models\cliente\Cliente;
use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "telefonos".
 *
 * @property int $id
 * @property int $cliente_id
 * @property string $numero
 * @property int $status
 *
 * @property Cliente $cliente
 */
class Telefono extends \yii\db\ActiveRecord {
  /**
   * {@inheritdoc}
   */
  public static function tableName() {
    return 'telefonos';
  }

  /**
   * {@inheritdoc}
   */
  public function rules() {
    return [
      [['cliente_id', 'numero'], 'required'],
      [['cliente_id'], 'integer'],
      [['numero'], 'string', 'max' => 10],
      [['status'], 'boolean', 'trueValue' => true, 'falseValue' => false]
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels() {
    return [
      'id' => 'ID',
      'cliente_id' => 'Cliente',
      'numero' => 'Número',
      'status' => 'Status',
    ];
  }

  public function getCliente(): ActiveQuery {
    return $this->hasOne(Cliente::class, ['id' => 'cliente_id']);
  }
}
