<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "visitors".
 *
 * @property integer $id
 * @property string $ip_address
 * @property string $action
 * @property string $date_time
 */
class Visitors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'visitors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ip_address', 'action'], 'required'],
            [['date_time'], 'safe'],
            [['ip_address'], 'string', 'max' => 100],
            [['action'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ip_address' => 'Ip Address',
            'action' => 'Action',
            'date_time' => 'Date Time',
        ];
    }
}
