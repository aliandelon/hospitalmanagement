<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "doctor_slot_time_mapping".
 *
 * @property integer $id
 * @property integer $day_mapping_id
 * @property integer $hospital_id
 * @property string $slot_time
 */
class DoctorSlotTimeMapping extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'doctor_slot_time_mapping';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['day_mapping_id', 'hospital_id', 'slot_time'], 'required'],
            [['day_mapping_id', 'hospital_id'], 'integer'],
            [['slot_time'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'day_mapping_id' => 'Day Mapping ID',
            'hospital_id' => 'Hospital ID',
            'slot_time' => 'Slot Time',
        ];
    }

    public function timeSaveDoctor($model){

        $con = \Yii::$app->db;
        $sql1 = "SELECT * FROM doctor_slot_time_mapping WHERE day_mapping_id = '$model->day_mapping_id' AND slot_time = '$model->slot_time'";
        $result = $con->createCommand($sql1)->queryAll();
        if(empty($result)){
            $sql = "INSERT into doctor_slot_time_mapping(day_mapping_id,slot_time)VALUES('$model->day_mapping_id','$model->slot_time');";
            $result = $con->createCommand($sql)->execute();
            return sizeof($result);
        }else{
            return 0;
        }
    }
}
