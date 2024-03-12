<?php

namespace app\models\auth;

use app\models\AppActiveRecord;
use Yii;

/**
 * This is the model class for table "auth_rule".
 *
 * @property string $name
 * @property resource|null $data
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property AuthItem[] $authItems
 */
class AuthRule extends AppActiveRecord {
  /**
   * {@inheritdoc}
   */
  public static function tableName() {
    return 'auth_rule';
  }

  /**
   * {@inheritdoc}
   */
  public function rules() {
    return [
      [['name'], 'required'],
      [['data'], 'string'],
      [['created_at', 'updated_at'], 'integer'],
      [['name'], 'string', 'max' => 64],
      [['name'], 'unique'],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels() {
    return [
      'name' => 'Name',
      'data' => 'Data',
      'created_at' => 'Created At',
      'updated_at' => 'Updated At',
    ];
  }

  /**
   * Gets query for [[AuthItems]].
   *
   * @return \yii\db\ActiveQuery
   */
  public function getAuthItems() {
    return $this->hasMany(AuthItem::class, ['rule_name' => 'name']);
  }
}
