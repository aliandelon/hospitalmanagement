<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "payment_details".
 *
 * @property integer $id
 * @property integer $patient_id
 * @property integer $hospital_clinic_id
 * @property integer $treatment_history_id
 * @property integer $slot_day_time_mapping_id
 * @property string $amount
 * @property integer $mode_payment
 * @property string $pay_date
 */
class PaymentDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment_details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['patient_id', 'hospital_clinic_id', 'treatment_history_id', 'slot_day_time_mapping_id', 'amount', 'mode_payment', 'pay_date'], 'required'],
            [['patient_id', 'hospital_clinic_id', 'treatment_history_id', 'slot_day_time_mapping_id', 'mode_payment'], 'integer'],
            [['amount'], 'number'],
            [['pay_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'patient_id' => 'Patient ID',
            'hospital_clinic_id' => 'Hospital Clinic ID',
            'treatment_history_id' => 'Treatment History ID',
            'slot_day_time_mapping_id' => 'Slot Day Time Mapping ID',
            'amount' => 'Amount',
            'mode_payment' => 'Mode Payment',
            'pay_date' => 'Pay Date',
        ];
    }
}
