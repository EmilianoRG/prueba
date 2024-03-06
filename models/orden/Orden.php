<?php

namespace app\models\orden;

use Yii;

/**
 * This is the model class for table "ordenes".
 *
 * @property int $id
 * @property int $servicio_id
 * @property int $cliente_id
 * @property string $descripcion
 * @property float $precio
 * @property string $fecha
 * @property int $status
 *
 * @property Clientes $cliente
 * @property Servicios $servicio
 */
class Orden extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ordenes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'servicio_id', 'cliente_id', 'descripcion', 'precio', 'fecha'], 'required'],
            [['id', 'servicio_id', 'cliente_id', 'status'], 'integer'],
            [['descripcion'], 'string'],
            [['precio'], 'number'],
            [['fecha'], 'safe'],
            [['id'], 'unique'],
            [['cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clientes::class, 'targetAttribute' => ['cliente_id' => 'id']],
            [['servicio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Servicios::class, 'targetAttribute' => ['servicio_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'servicio_id' => 'Servicio ID',
            'cliente_id' => 'Cliente ID',
            'descripcion' => 'Descripcion',
            'precio' => 'Precio',
            'fecha' => 'Fecha',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Cliente]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCliente()
    {
        return $this->hasOne(Clientes::class, ['id' => 'cliente_id']);
    }

    /**
     * Gets query for [[Servicio]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServicio()
    {
        return $this->hasOne(Servicios::class, ['id' => 'servicio_id']);
    }
}
