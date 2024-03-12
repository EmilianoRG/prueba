<?php
namespace app\models\usuario;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class UsuarioSearch extends Usuario {
  public function rules(): array {
    return [
      [['id', 'status'], 'integer'],
      [['nombre', 'usuario', 'password', 'rol'], 'safe']
    ];
  }

  public function scenarios(): array {
    return Model::scenarios();
  }

  public function search($params): ActiveDataProvider {
    $query = Usuario::find();
    $dataProvider = new ActiveDataProvider([
      'query' => $query,
      'pagination' => ['pageSize' => 10],
      'sort' => [
        'defaultOrder' => ['nombre' => SORT_ASC]
      ]
    ]);
    $this->load($params);
    if (!$this->validate()) {
      return $dataProvider;
    }
    $query->andFilterWhere([
      'id' => $this->id,
      'status' => $this->status,
    ]);
    $query->andFilterWhere(['like', 'nombre', $this->nombre])
      ->andFilterWhere(['like', 'usuario', $this->usuario])
      ->andFilterWhere(['like', 'password', $this->password])
      ->andFilterWhere(['like', 'rol', $this->rol]);
    return $dataProvider;
  }
}
