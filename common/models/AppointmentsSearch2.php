<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Appointments;

/**
 * AppointmentsSearch represents the model behind the search form about `common\models\Appointments`.
 */
class AppointmentsSearch extends Appointments
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'patient_id', 'doctor_id', 'investigation_id', 'slot_day_time_mapping_id', 'hospital_clinic_id', 'appointment_type'], 'integer'],
            [['app_date', 'app_time'], 'safe'],
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
        $query = Appointments::find();

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
            'patient_id' => $this->patient_id,
            'doctor_id' => $this->doctor_id,
            'investigation_id' => $this->investigation_id,
            'slot_day_time_mapping_id' => $this->slot_day_time_mapping_id,
            'hospital_clinic_id' => $this->hospital_clinic_id,
            // 'app_date' => $this->app_date,
            'appointment_type' => $this->appointment_type,
        ]);

        $query->andFilterWhere(['like', 'app_time', $this->app_time]);

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search1($params)
    {
        $query = Appointments::find();

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
            // 'id' => $this->id,
            'patient_id' => $this->patient_id,
            'doctor_id' => $this->doctor_id,
            // 'investigation_id' => $this->investigation_id,
            'slot_day_time_mapping_id' => $this->slot_day_time_mapping_id,
            // 'hospital_clinic_id' => $this->hospital_clinic_id,
            // // 'app_date' => $this->app_date,
            'appointment_type' => $this->appointment_type,
        ]);

        $query->andFilterWhere(['like', 'app_time', $this->app_time]);
        $query->andFilterWhere(['=', 'appointment_type', 1]);
        $query->andFilterWhere(['=', 'hospital_clinic_id', Yii::$app->user->identity->id]);


        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search2($params)
    {
       
        $query = Appointments::find();
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
            // 'id' => $this->id,
            'patient_id' => $this->patient_id,
            // 'doctor_id' => $this->doctor_id,
            'investigation_id' => $this->investigation_id,
            'slot_day_time_mapping_id' => $this->slot_day_time_mapping_id,
            // 'hospital_clinic_id' => $this->hospital_clinic_id,
            'app_date' => $this->app_date,
            'appointment_type' => $this->appointment_type,
        ]);

        $query->andFilterWhere(['like', 'app_time', $this->app_time]);
         $query->andFilterWhere(['=', 'appointment_type', 0]);
        $query->andFilterWhere(['=', 'hospital_clinic_id', Yii::$app->user->identity->id]);

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchToday($params)
    {
        $query = Appointments::find();
        $date =  date("Y-m-d");

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
            // 'id' => $this->id,
            // 'patient_id' => $this->patient_id,
            'doctor_id' => $this->doctor_id,
            'investigation_id' => $this->investigation_id,
            // 'slot_day_time_mapping_id' => $this->slot_day_time_mapping_id,
            // 'hospital_clinic_id' => $this->hospital_clinic_id,
            // 'app_date' =>  $date,
            'appointment_type' => $params['type'],
        ]);
        if($params['type']!=1){
            $query->andFilterWhere(['=', 'investigation_id', $this->investigation_id]);
        }

        return $dataProvider;
    }
}
