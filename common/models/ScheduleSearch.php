<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Schedule;

/**
 * ScheduleSearch represents the model behind the search form about `common\models\Schedule`.
 */
class ScheduleSearch extends Schedule
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'investigation_id', 'hospital_id', 'doctor_id', 'sunday_holiday', 'status'], 'integer'],
            [['created_on','category'], 'safe'],
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
        $query = Schedule::find();

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
            'investigation_id' => $this->investigation_id,
            'hospital_id' => $this->hospital_id,
            'doctor_id' => $this->doctor_id,
            'sunday_holiday' => $this->sunday_holiday,
            'status' => $this->status,
            'created_on' => $this->created_on,
        ]);
        if($this->category != '')
        {
            $query->joinWith('investigations');
            $query->andFilterWhere(['mst_id' =>$this->category]);
        }

        return $dataProvider;
    }



     public function searchDoctor($params)
    {
        $query = Schedule::find();

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
            'investigation_id' => $this->investigation_id,
            'hospital_id' => $this->hospital_id,
            'doctor_id' => $this->doctor_id,
            'sunday_holiday' => $this->sunday_holiday,
            'status' => $this->status,
            'created_on' => $this->created_on,
        ]);
        $query->andWhere(['=','hospital_id',Yii::$app->user->identity->id]);
        // $query->andWhere(['=','doctor_id',$doctorId]);    

        return $dataProvider;
    }





    
}
