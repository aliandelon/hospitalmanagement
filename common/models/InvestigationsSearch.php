<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Investigations;

/**
 * InvestigationsSearch represents the model behind the search form of `common\models\Investigations`.
 */
class InvestigationsSearch extends Investigations
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'mst_id', 'status', 'created_by_type'], 'integer'],
            [['investigation_name', 'created_on'], 'safe'],
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
        $query = Investigations::find();

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
            'mst_id' => $this->mst_id,
            'status' => $this->status,
            'created_on' => $this->created_on,
            'created_by_type' => $this->created_by_type,
        ]);

        $query->andFilterWhere(['like', 'investigation_name', $this->investigation_name]);

        return $dataProvider;
    }
}
