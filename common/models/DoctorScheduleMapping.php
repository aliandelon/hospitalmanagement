<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "doctor_schedule_mapping".
 *
 * @property integer $id
 * @property integer $doctor_id
 * @property integer $hospital_clinic_id
 * @property string $amount
 * @property integer $status
 */
class DoctorScheduleMapping extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'doctor_schedule_mapping';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['doctor_id', 'hospital_clinic_id', 'amount', 'status'], 'required'],
            [['doctor_id', 'hospital_clinic_id', 'status'], 'integer'],
            [['amount'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'doctor_id' => 'Doctor ID',
            'hospital_clinic_id' => 'Hospital Clinic ID',
            'amount' => 'Amount',
            'status' => 'Status',
        ];
    }
    public function saveDoctorInvestigation($con,$model)
    {

        $query = "SELECT id from  doctor_schedule_mapping where doctor_id='$model->doctor_id' and hospital_clinic_id = '$model->hospital_clinic_id' AND status =1;";

        $result = $con->createCommand($query)->queryOne();
        // print_r($result);exit;
        if($result['id']){
             $query = "UPDATE doctor_schedule_mapping SET amount = '$model->amount' where doctor_id='$model->doctor_id' and hospital_clinic_id = '$model->hospital_clinic_id' AND status =1;";
             // echo $query;exit;
        $result = $con->createCommand($query)->execute();
        return true;
        }else{
            $sql = "INSERT into doctor_schedule_mapping(doctor_id,hospital_clinic_id,amount,status)VALUES('$model->doctor_id','$model->hospital_clinic_id','$model->amount','1');";
            $result = $con->createCommand($sql)->execute();
            return $result;
        }

    }
}
