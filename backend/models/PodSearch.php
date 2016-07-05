<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pod;

/**
 * PodSearch represents the model behind the search form about `app\models\Pod`.
 */
class PodSearch extends Pod
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idpod', 'idFil'], 'integer'],
            [['podcol'], 'safe'],
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
        $query = Pod::find()->orderBy('idFil');

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
            'idpod' => $this->idpod,
            'idFil' => $this->idFil,
        ]);

        $query->andFilterWhere(['like', 'podcol', $this->podcol]);

        return $dataProvider;
    }
}
