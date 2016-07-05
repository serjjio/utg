<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Auto;

/**
 * AutoSearch represents the model behind the search form about `app\models\Auto`.
 */
class AutoSearch extends Auto
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idTs', 'typeTs', 'idMarka', 'V', 'fil', 'pod', 'id_model'], 'integer'],
            [['gosNum', 'model', 'comment', 'inv'], 'safe'],
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
        $query = Auto::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        /*$dataProvider->setSort([
                'attributes' => [
                    
                ]
            ]);*/

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idTs' => $this->idTs,
            'typeTs' => $this->typeTs,
            'idMarka' => $this->idMarka,
            'V' => $this->V,
            'fil' => $this->fil,
            'pod' => $this->pod,
            'id_model' => $this->id_model,
        ]);

        $query->andFilterWhere(['like', 'gosNum', $this->gosNum])
            ->andFilterWhere(['like', 'inv', $this->inv])
            //->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
