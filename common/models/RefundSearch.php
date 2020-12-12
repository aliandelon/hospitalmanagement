<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Refund;

/**
 * RefundSearch represents the model behind the search form about `common\models\Refund`.
 */
class RefundSearch extends Refund
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'booking_id', 'patient_id', 'doctor_id', 'investigation_id', 'hospital_clinic_id', 'status'], 'integer'],
            [['razorpay_refund_id', 'razorpay_payment_id', 'razorpay_order_id', 'app_date', 'app_time'], 'safe'],
            [['price'], 'number'],
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
        $query = Refund::find();

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
            'booking_id' => $this->booking_id,
            'patient_id' => $this->patient_id,
            'doctor_id' => $this->doctor_id,
            'investigation_id' => $this->investigation_id,
            'hospital_clinic_id' => $this->hospital_clinic_id,
            'app_date' => $this->app_date,
            'app_time' => $this->app_time,
            'price' => $this->price,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'razorpay_refund_id', $this->razorpay_refund_id])
            ->andFilterWhere(['like', 'razorpay_payment_id', $this->razorpay_payment_id])
            ->andFilterWhere(['like', 'razorpay_order_id', $this->razorpay_order_id]);

        return $dataProvider;
    }
}
