<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PaymentDetails;

/**
 * PaymentDetailsSearch represents the model behind the search form about `common\models\PaymentDetails`.
 */
class PaymentDetailsSearch extends PaymentDetails
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'patient_id', 'hospital_clinic_id', 'treatment_history_id', 'slot_day_time_mapping_id', 'mode_payment'], 'integer'],
            [['amount'], 'number'],
            [['pay_date'], 'safe'],
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
        $query = PaymentDetails::find();

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
            'hospital_clinic_id' => $this->hospital_clinic_id,
            'treatment_history_id' => $this->treatment_history_id,
            'slot_day_time_mapping_id' => $this->slot_day_time_mapping_id,
            'amount' => $this->amount,
            'mode_payment' => $this->mode_payment,
            'pay_date' => $this->pay_date,
        ]);

        return $dataProvider;
    }
}
