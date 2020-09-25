<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "slot_day_time_mapping".
 *
 * @property integer $id
 * @property integer $slot_day_id
 * @property integer $hospital_clinic_id
 * @property string $from_time
 * @property string $to_time
 */
class SlotDayTimeMapping extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'slot_day_time_mapping';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['slot_day_id', 'hospital_clinic_id', 'from_time', 'to_time'], 'required'],
            [['slot_day_id', 'hospital_clinic_id'], 'integer'],
            [['from_time', 'to_time'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'slot_day_id' => 'Slot Day ID',
            'hospital_clinic_id' => 'Hospital Clinic ID',
            'from_time' => 'From Time',
            'to_time' => 'To Time',
        ];
    }

    public function saveSlotTime($con, $model)
    {
        $check = "SELECT count(slot_day_id) cnt FROM slot_day_time_mapping WHERE 
                slot_day_id = '$model->slot_day_id' AND hospital_clinic_id = '$model->hospital_clinic_id' AND investigation_id = '$model->investigation_id' AND from_time = '$model->from_time' AND to_time = '$model->to_time';";
        $count = $con->createCommand($check)->queryOne();
        if($count)
        {
            if($count['cnt'] > 0)
            {
                $con->createCommand("DELETE FROM slot_day_time_mapping WHERE 
                slot_day_id = '$model->slot_day_id' AND hospital_clinic_id = '$model->hospital_clinic_id' AND investigation_id = '$model->investigation_id' AND from_time = '$model->from_time' AND to_time = '$model->to_time';")->execute();
            }
        }
        $sql= "INSERT INTO slot_day_time_mapping(slot_day_id,hospital_clinic_id,investigation_id,from_time,to_time)VALUES('$model->slot_day_id','$model->hospital_clinic_id','$model->investigation_id','$model->from_time','$model->to_time');";
        $result  = $con->createCommand($sql)->execute();
        return $result;
    }

    public function saveDoctorSlotTime($con, $model)
    {
        $check = "SELECT count(slot_day_id) cnt FROM slot_day_time_mapping WHERE 
                slot_day_id = '$model->slot_day_id' AND hospital_clinic_id = '$model->hospital_clinic_id' AND doctor_id = '$model->doctor_id' AND from_time = '$model->from_time' AND to_time = '$model->to_time';";
        $count = $con->createCommand($check)->queryOne();
        if($count)
        {
            if($count['cnt'] > 0)
            {
                $con->createCommand("DELETE FROM slot_day_time_mapping WHERE 
                slot_day_id = '$model->slot_day_id' AND hospital_clinic_id = '$model->hospital_clinic_id' AND from_time = '$model->from_time' AND to_time = '$model->to_time' AND doctor_id = '$model->doctor_id';")->execute();
            }
        }
        $sql= "INSERT INTO slot_day_time_mapping(slot_day_id,hospital_clinic_id,doctor_id,from_time,to_time)VALUES('$model->slot_day_id','$model->hospital_clinic_id','$model->doctor_id','$model->from_time','$model->to_time');";
        $result  = $con->createCommand($sql)->execute();
        return $result;
    }
}
