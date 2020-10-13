<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SlotDayMapping;

/**
 * SlotDayMappingSearch represents the model behind the search form about `common\models\SlotDayMapping`.
 */
class SlotDayMappingSearch extends SlotDayMapping
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'investigation_id', 'hospital_clinic_id', 'doctor_id'], 'integer'],
            [['day'], 'safe'],
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
        $query = SlotDayMapping::find();

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
            'hospital_clinic_id' => $this->hospital_clinic_id,
            'doctor_id' => $this->doctor_id,
        ]);

        $query->andFilterWhere(['like', 'day', $this->day]);

        return $dataProvider;
    }
     public function searchDoctor($params,$doctorId)
    {
        $query = SlotDayMapping::find();

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
            'hospital_clinic_id' => $this->hospital_clinic_id,
            'doctor_id' => $this->doctor_id,
        ]);

        $query->andFilterWhere(['like', 'day', $this->day]);
        $query->andFilterWhere(['=', 'doctor_id', $doctorId]);
        return $dataProvider;
    }
}
