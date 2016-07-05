<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Unit;

/**
 * UnitSearch represents the model behind the search form about `app\models\Unit`.
 */
class UnitSearch extends Unit
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['blok', 'IMEI', 'idConfig', 'idFw', 'name_block', 'idSim', 'idICC'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Unit::find();

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
        $query->joinWith('idSim0', 'idICC0');
        //$query->joinWith('idICC0');

        // grid filtering conditions
        $query->andFilterWhere([
            //'blok' => $this->blok,
            //'IMEI' => $this->IMEI,
            //'idSim' => $this->idSim,
            'idConfig' => $this->idConfig,
            'idFw' => $this->idFw,
            'name_block' => $this->name_block,
            //'ICC' => ICC,
        ]);

        $query->andFilterWhere(['like', 'sim.SIM', $this->idSim])
              ->andFilterWhere(['like', 'sim.icc', $this->idICC])
              ->andFilterWhere(['like', 'IMEI', $this->IMEI]);

        return $dataProvider;
    }
}
