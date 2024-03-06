<?php

namespace app\models\telefono;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\telefono\Telefono;

/**
 * TelefonoSearch represents the model behind the search form of `app\models\telefono\Telefono`.
 */
class TelefonoSearch extends Telefono
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'cliente_id', 'status'], 'integer'],
            [['numero'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
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
    public function search($params)
    {
        $query = Telefono::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'cliente_id' => $this->cliente_id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'numero', $this->numero]);

        return $dataProvider;
    }
}
