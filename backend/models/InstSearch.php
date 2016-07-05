<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Inst;

/**
 * InstSearch represents the model behind the search form about `app\models\Inst`.
 */
class InstSearch extends Inst
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'idAuto', 'V', 'dut', 'biz', 'col', 'active'], 'integer'],
            [['date', 'point', 'comment', 'idInstaller', 'id_fil', 'id_pod', 'blok'], 'safe'],
            [['moto'], 'number'],
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
        $query = Inst::find()->where(['active' => 1]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->setPagination(['pageSize'=>50]);

        $this->load($params);

       if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->joinWith('blok0');
        $query->joinWith('idInstaller0');
        $query->joinWith('idFil0');
        $query->joinWith('idPod0');
        
        //$query->joinWith('blok0');

        // grid filtering conditions
        $query->andFilterWhere([
            'ID' => $this->ID,
            'date' => $this->date,
            'idAuto' => $this->idAuto,
            //'blok' => $this->blok,
            //'idInstaller' => $this->idInstaller,
            'V' => $this->V,
            'dut' => $this->dut,
            'biz' => $this->biz,
            'moto' => $this->moto,
            'col' => $this->col,
            //'fil' => $this->fil,
        ]);

        $query->andFilterWhere(['like', 'point', $this->point])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'unit.name_block', $this->blok])
            ->andFilterWhere(['like', 'installer.integrator', $this->idInstaller])
            ->andFilterWhere(['like', 'fil.fil', $this->id_fil])
            ->andFilterWhere(['like', 'pod.podcol', $this->id_pod]);

        return $dataProvider;
    }
}
