<?php

namespace app\models\orden;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\orden\Orden;

/**
 * OrdenSearch represents the model behind the search form of `app\models\orden\Orden`.
 */
class OrdenSearch extends Orden
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'servicio_id', 'cliente_id', 'status'], 'integer'],
            [['descripcion', 'fecha'], 'safe'],
            [['precio'], 'number'],
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
        $query = Orden::find();

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
            'servicio_id' => $this->servicio_id,
            'cliente_id' => $this->cliente_id,
            'precio' => $this->precio,
            'fecha' => $this->fecha,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}
