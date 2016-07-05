<?php

namespace app\models;

use Yii;

use yii\data\ActiveDataProvider;
use app\models\Model;

/**
 * ModelSearch represents the model behind the search form about `app\models\Model`.
 */
class ModelSearch extends Model
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idmodel'], 'integer'],
            [['name_model', 'id_marka'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return yii\base\Model::scenarios();
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
        $query = Model::find()->orderBy('id_marka');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->joinWith('idMarka');

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idmodel' => $this->idmodel,
            'id_marka' => $this->id_marka,
        ]);

        $query->andFilterWhere(['like', 'name_model', $this->name_model])
              //->andFilterWhere(['like', 'marka.marka', $this->id_marka])

            ;

        return $dataProvider;
    }
}
