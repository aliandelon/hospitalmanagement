<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "doctor_hospital_day_mapping".
 *
 * @property integer $id
 * @property integer $hospital_id
 * @property integer $doctor_id
 * @property integer $day_id
 */
class DoctorHospitalDayMapping extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'doctor_hospital_day_mapping';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hospital_id', 'doctor_id', 'day_id'], 'required'],
            [['hospital_id', 'doctor_id', 'day_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hospital_id' => 'Hospital ID',
            'doctor_id' => 'Doctor ID',
            'day_id' => 'Day ID',
        ];
    }

    public function daySaveDoctor($model){
        $con = \Yii::$app->db;
         $sql1 = "SELECT * FROM doctor_hospital_day_mapping WHERE doctor_id = '$model->doctor_id' AND hospital_id = '$model->hospital_id' AND day_id = '$model->day_id'";
        $result = $con->createCommand($sql1)->queryAll();
        if(empty($result)){
            $sql = "INSERT into doctor_hospital_day_mapping(hospital_id,doctor_id,day_id)VALUES('$model->hospital_id','$model->doctor_id','$model->day_id');";
            $result = $con->createCommand($sql)->execute();
            $id = Yii::$app->db->getLastInsertID();
        }else{
            $id = $result[0]['id'];
            $sql = "UPDATE doctor_hospital_day_mapping SET day_id = '$model->day_id' WHERE hospital_id = '$model->hospital_id' AND doctor_id = '$model->doctor_id' AND day_id = '$model->day_id'";
            $result = $con->createCommand($sql)->execute();
        }
        return $id;
    }
}
