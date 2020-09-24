<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "slot_day_mapping".
 *
 * @property integer $id
 * @property integer $investigation_id
 * @property integer $hospital_clinic_id
 * @property string $day
 */
class SlotDayMapping extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'slot_day_mapping';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['investigation_id', 'hospital_clinic_id', 'day'], 'required'],
            [['investigation_id', 'hospital_clinic_id'], 'integer'],
            [['day'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'investigation_id' => 'Investigation ID',
            'hospital_clinic_id' => 'Hospital Clinic ID',
            'day' => 'Day',
        ];
    }

    public function saveSlotDayMapping($con,$model)
    {
        $check = "SELECT id  FROM slot_day_mapping WHERE investigation_id = '$model->investigation_id' AND hospital_clinic_id = '$model->hospital_clinic_id' AND day = '$model->day';";
        $result = $con->createCommand($check)->queryOne();
        if($result && isset($result['id']))
        {
            return $result['id'];
        }else{
            $query = "INSERT INTO slot_day_mapping(investigation_id,hospital_clinic_id,day)VALUES('$model->investigation_id','$model->hospital_clinic_id','$model->day');";
            $result = $con->createCommand($query)->execute();
            return $con->getLastInsertId();
        }
    }

    public function saveDoctorSlotDayMapping($con,$model)
    {
        $check = "SELECT id  FROM slot_day_mapping WHERE doctor_id = '$model->doctor_id' AND hospital_clinic_id = '$model->hospital_clinic_id' AND day = '$model->day';";
        $result = $con->createCommand($check)->queryOne();
        if($result && isset($result['id']))
        {
            return $result['id'];
        }else{
            $query = "INSERT INTO slot_day_mapping(investigation_id,doctor_id,hospital_clinic_id,day)VALUES('$model->investigation_id','$model->doctor_id','$model->hospital_clinic_id','$model->day');";
            $result = $con->createCommand($query)->execute();
            return $con->getLastInsertId();
        }
    }
}
