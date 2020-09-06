<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "master_countries".
 *
 * @property integer $id
 * @property string $country_name
 * @property integer $status
 * @property integer $zone
 */
class Countries extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'master_countries';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_name'], 'required'],
            [['status', 'zone'], 'integer'],
            [['country_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country_name' => 'Country Name',
            'status' => 'Status',
            'zone' => 'Zone',
        ];
    }
}
