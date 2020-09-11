<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RolesMst;

/**
 * RolesMstSearch represents the model behind the search form about `common\models\RolesMst`.
 */
class RolesMstSearch extends RolesMst
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'task', 'sort_order', 'status'], 'integer'],
            [['sub_task'], 'safe'],
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
        $query = RolesMst::find();

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
            'task' => $this->task,
            'sort_order' => $this->sort_order,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'sub_task', $this->sub_task]);

        return $dataProvider;
    }
}
