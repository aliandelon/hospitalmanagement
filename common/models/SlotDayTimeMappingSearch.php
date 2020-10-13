<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SlotDayTimeMapping;

/**
 * SlotDayTimeMappingSearch represents the model behind the search form about `common\models\SlotDayTimeMapping`.
 */
class SlotDayTimeMappingSearch extends SlotDayTimeMapping
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'slot_day_id', 'hospital_clinic_id', 'doctor_id', 'investigation_id'], 'integer'],
            [['from_time', 'to_time'], 'safe'],
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
        $query = SlotDayTimeMapping::find();

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
            'slot_day_id' => $this->slot_day_id,
            'hospital_clinic_id' => $this->hospital_clinic_id,
            'doctor_id' => $this->doctor_id,
            'investigation_id' => $this->investigation_id,
            'from_time' => $this->from_time,
            'to_time' => $this->to_time,
        ]);

        return $dataProvider;
    }
}
