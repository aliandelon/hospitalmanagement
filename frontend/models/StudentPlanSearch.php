<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\StudentPlan;

/**
 * StudentPlanSearch represents the model behind the search form about `frontend\models\StudentPlan`.
 */
class StudentPlanSearch extends StudentPlan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'student_id', 'plan_id', 'status', 'free_trial'], 'integer'],
            [['cod', 'start_date', 'expiry_date', 'uod', 'free_start', 'free_end'], 'safe'],
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
        $query = StudentPlan::find();

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
            'student_id' => $this->student_id,
            'plan_id' => $this->plan_id,
            'cod' => $this->cod,
            'start_date' => $this->start_date,
            'expiry_date' => $this->expiry_date,
            'uod' => $this->uod,
            'status' => $this->status,
            'free_trial' => $this->free_trial,
            'free_start' => $this->free_start,
            'free_end' => $this->free_end,
        ]);

        return $dataProvider;
    }
}
