<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "payment_verification".
 *
 * @property integer $id
 * @property string $booking_id
 * @property string $razorpay_order_id
 * @property string $razorpay_payment_id
 * @property string $razorpay_signature
 * @property integer $status
 * @property integer $cancelled
 */
class PaymentVerification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment_verification';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['razorpay_order_id', 'razorpay_payment_id', 'razorpay_signature'], 'required'],
            [['status', 'cancelled'], 'integer'],
            [['booking_id', 'razorpay_order_id', 'razorpay_payment_id', 'razorpay_signature'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'booking_id' => 'Booking ID',
            'razorpay_order_id' => 'Razorpay Order ID',
            'razorpay_payment_id' => 'Razorpay Payment ID',
            'razorpay_signature' => 'Razorpay Signature',
            'status' => 'Status',
            'cancelled' => 'Cancelled',
        ];
    }
}
