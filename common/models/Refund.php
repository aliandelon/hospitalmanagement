<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "refund".
 *
 * @property integer $id
 * @property string $razorpay_refund_id
 * @property string $razorpay_payment_id
 * @property string $razorpay_order_id
 * @property integer $booking_id
 * @property integer $patient_id
 * @property integer $doctor_id
 * @property integer $investigation_id
 * @property integer $hospital_clinic_id
 * @property string $app_date
 * @property string $app_time
 * @property string $price
 * @property integer $status
 */
class Refund extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'refund';
    }
// investigo_test
    // EvIoq^R_Bz]x
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'razorpay_payment_id', 'razorpay_order_id', 'booking_id', 'patient_id', 'hospital_clinic_id', 'app_date', 'app_time', 'status'], 'required'],
            [['booking_id', 'patient_id', 'doctor_id', 'investigation_id', 'hospital_clinic_id', 'status'], 'integer'],
            [['app_date', 'app_time'], 'safe'],
            [['price'], 'number'],
            [['razorpay_refund_id', 'razorpay_payment_id', 'razorpay_order_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'razorpay_refund_id' => 'Razorpay Refund ID',
            'razorpay_payment_id' => 'Razorpay Payment ID',
            'razorpay_order_id' => 'Razorpay Order ID',
            'booking_id' => 'Booking ID',
            'patient_id' => 'Patient ID',
            'doctor_id' => 'Doctor ID',
            'investigation_id' => 'Investigation ID',
            'hospital_clinic_id' => 'Hospital Clinic ID',
            'app_date' => 'App Date',
            'app_time' => 'App Time',
            'price' => 'Price',
            'status' => 'Status',
        ];
    }
}
