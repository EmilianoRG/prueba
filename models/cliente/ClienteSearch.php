<?php

namespace app\models\cliente;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\cliente\Cliente;

/**
 * ClienteSearch represents the model behind the search form of `app\models\cliente\Cliente`.
 */
class ClienteSearch extends Cliente {
  /**
   * {@inheritdoc}
   */
  public function rules() {
    return [
      [['id', 'edad', 'status'], 'integer'],
      [['nombre', 'apellido_paterno', 'apellido_materno', 'correo', 'domicilio'], 'safe'],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function scenarios() {
    // bypass scenarios() implementation in the parent class
    return Model::scenarios();
  }

  /**
   * Creates data provider instance with search query applied
   *
   * @param array $params
   *
   * @return ActiveDataProvider
   */
  public function search($params) {
    $query = Cliente::find()->where(['status' => true]);

    // add conditions that should always apply here

    $dataProvider = new ActiveDataProvider([
      'query' => $query,
      'pagination' => ['pageSize' => 10],
      'sort' => [
        'defaultOrder' => ['nombre' => SORT_ASC]
      ]
    ]);

    $this->load($params);

    if (!$this->validate()) {
      // uncomment the following line if you do not want to return any records when validation fails
      // $query->where('0=1');
      return $dataProvider;
    }

    // grid filtering conditions
    $query->andFilterWhere([
      'id' => $this->id,
      'edad' => $this->edad,
      'status' => $this->status,
    ]);

    $query->andFilterWhere(['like', 'nombre', $this->nombre])
      ->andFilterWhere(['like', 'apellido_paterno', $this->apellido_paterno])
      ->andFilterWhere(['like', 'apellido_materno', $this->apellido_materno])
      ->andFilterWhere(['like', 'correo', $this->correo])
      ->andFilterWhere(['like', 'domicilio', $this->domicilio]);

    return $dataProvider;
  }
}
