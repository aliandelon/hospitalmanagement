<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "package_payment".
 *
 * @property integer $id
 * @property string $payment_id
 * @property string $entity
 * @property string $amount
 * @property string $currency
 * @property string $status
 * @property string $order_id
 * @property string $invoice_id
 * @property string $method
 * @property string $amount_refunded
 * @property string $refund_status
 * @property string $description
 * @property string $card_id
 * @property string $bank
 * @property string $wallet
 * @property string $email
 * @property string $contact
 * @property string $fee
 * @property string $tax
 * @property string $expiry_date
 */
class PackagePayment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'package_payment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['payment_id', 'entity', 'amount', 'currency', 'status', 'order_id', 'invoice_id', 'method', 'amount_refunded', 'refund_status', 'description', 'card_id', 'bank', 'wallet', 'email', 'contact', 'fee', 'tax'], 'required'],
            [['amount', 'amount_refunded', 'fee', 'tax'], 'number'],
            [['expiry_date'], 'safe'],
            [['payment_id', 'entity', 'status', 'order_id', 'invoice_id', 'method', 'refund_status', 'description', 'bank', 'wallet', 'email'], 'string', 'max' => 250],
            [['currency'], 'string', 'max' => 10],
            [['card_id'], 'string', 'max' => 50],
            [['contact'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'payment_id' => 'Payment ID',
            'entity' => 'Entity',
            'amount' => 'Amount',
            'currency' => 'Currency',
            'status' => 'Status',
            'order_id' => 'Order ID',
            'invoice_id' => 'Invoice ID',
            'method' => 'Method',
            'amount_refunded' => 'Amount Refunded',
            'refund_status' => 'Refund Status',
            'description' => 'Description',
            'card_id' => 'Card ID',
            'bank' => 'Bank',
            'wallet' => 'Wallet',
            'email' => 'Email',
            'contact' => 'Contact',
            'fee' => 'Fee',
            'tax' => 'Tax',
            'expiry_date' => 'Expiry Date',
        ];
    }
}
