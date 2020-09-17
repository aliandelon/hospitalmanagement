<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "doctor_specialty_mst".
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 * @property string $created_on
 */
class DoctorSpecialtyMst extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'doctor_specialty_mst';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'status'], 'required'],
            [['status'], 'integer'],
            [['created_on'], 'safe'],
            [['name'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status',
            'created_on' => 'Created On',
        ];
    }
}
