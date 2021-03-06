<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "schedule".
 *
 * @property integer $id
 * @property integer $investigation_id
 * @property integer $hospital_id
 * @property integer $doctor_id
 * @property integer $sunday_holiday
 * @property integer $status
 * @property string $created_on
 * @property integer $amount
 */
class Schedule extends \yii\db\ActiveRecord
{
    public $amount; 
    public $category; 
    public $day;
    public $isHomeCollection;
    public $details;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'schedule';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['investigation_id', 'hospital_id','amount','details'], 'required'],
            [['id', 'investigation_id', 'hospital_id', 'doctor_id', 'sunday_holiday', 'status'], 'integer'],
            [['created_on','amount','category'], 'safe'],
            //['amount', 'PriceValidator'],
            ['amount', 'match', 'pattern'=>'/^[¥£$€]?[ ]?[-]?[ ]?[0-9]*[.,]{0,1}[0-9]{0,2}[ ]?[¥£$€]?$/'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'investigation_id' => 'Investigation',
            'hospital_id' => 'Hospital',
            'doctor_id' => 'Doctor',
            'sunday_holiday' => 'Sunday Holiday',
            'status' => 'Status',
            'created_on' => 'Created On',
        ];
    }

    public function getDoctor()
    {
        return $this->hasOne(DoctorsDetails::class, ['id' => 'doctor_id']);
    }

    public function getHospital()
    {
        return $this->hasOne(HospitalClinicDetails::class, ['user_id' => 'hospital_id']);
    }

    public function getInvestigations()
    {
        return $this->hasOne(Investigations::class, ['id' => 'investigation_id']);
    }

    public function getInvestigationList($category)
    {
        $con = \Yii::$app->db;
        $query = "SELECT inv.id,inv.investigation_name,hos.amount,hos.details,hos.isHomeCollection FROM investigations inv LEFT JOIN hospital_investigation_mapping hos ON inv.id = hos.investigation_id WHERE inv.mst_id = '$category' AND inv.status =1;";
        $result = $con->createCommand($query)->queryAll();
        return $result;
    }
    
    public function getInvestigationDaySlotDetails($investigationId)
    {
        $con = \Yii::$app->db;
        $query = "SELECT hos.day_id,slot.slot_time FROM investigations inv LEFT JOIN hospital_investigation_day_mapping hos ON inv.id = hos.investigation_id left join sloat_time_mapping slot ON hos.id=slot.investigation_mapping_id WHERE inv.id = '$investigationId' AND inv.status =1 AND slot.slot_time <> '' ORDER BY hos.day_id;";
        $result = $con->createCommand($query)->queryAll();
        return $result;
    }

    public function checkScheduleExist($con, $model)
    {
        
        $query = "SELECT count(*)cnt from  schedule where investigation_id='$model->investigation_id' and hospital_id = '$model->hospital_id' AND doctor_id = $model->doctor_id AND status =1;";
        $result = $con->createCommand($query)->queryOne();
        return $result['cnt'];
    }

    public function viewSchedule($con, $hospital, $Investigation)
    {
        $query = "SELECT DISTINCT daytime.from_time as start,
        daytime.to_time as end,
        'bg-success' as className 
            FROM slot_day_time_mapping daytime
            JOIN slot_day_mapping day ON day.hospital_clinic_id = daytime.hospital_clinic_id AND day.investigation_id = daytime.investigation_id
            WHERE daytime.hospital_clinic_id = '$hospital' AND 
            day.investigation_id = '$Investigation' AND daytime.doctor_id IS NULL";
        $result = $con->createCommand($query)->queryAll();
        return $result;
    }

    public function getScheduleDetails($hospital, $Investigation)
    {
        $con = \Yii::$app->db;
        $query = "SELECT hospInv.amount,hospInv.isHomeCollection,hospInv.details
            FROM schedule sh
            JOIN hospital_investigation_mapping hospInv ON hospInv.hospital_clinic_id = sh.hospital_id AND hospInv.investigation_id = sh.investigation_id   
            WHERE sh.hospital_id = '$hospital' AND sh.investigation_id = '$Investigation'";
        $result = $con->createCommand($query)->queryAll();
        return $result;
    }
     public function getDoctorScheduleDetails($hospital, $docId)
    {
        $con = \Yii::$app->db;
        $query = "SELECT docSch.amount
            FROM schedule sh
            JOIN doctor_schedule_mapping docSch ON docSch.hospital_clinic_id = sh.hospital_id AND docSch.doctor_id = sh.doctor_id   
            WHERE sh.hospital_id = '$hospital' AND sh.doctor_id = '$docId'";
        $result = $con->createCommand($query)->queryAll();
        return $result;
    }
    
    public function createSchedule($con, $model)
    {
        $check = "SELECT count(investigation_id) cnt FROM schedule WHERE investigation_id = '$model->investigation_id' AND hospital_id = '$model->hospital_id';";
        $count = $con->createCommand($check)->queryOne();
        if($count['cnt'] > 0){
            return true;
        }else
        {
            $sql = "INSERT INTO schedule(investigation_id,hospital_id)values('$model->investigation_id','$model->hospital_id');";
            $result = $con->createCommand($sql)->execute();
            return $result;
        }

    }

    public function deleteSchedule($model, $startDate, $endDate)
    {
        $con = \Yii::$app->db;
        $date = date('Y-m-d',strtotime($endDate));
        $slotQuery = "SELECT id from slot_day_mapping WHERE investigation_id = '$model->investigation_id' AND hospital_clinic_id = '$model->hospital_id'
        AND day = '$date';";
        $slotResult = $con->createCommand($slotQuery)->queryOne();
        if($slotResult)
        {
            $slotId = $slotResult['id'];
            $sql = "DELETE FROM slot_day_time_mapping WHERE slot_day_id = '$slotId' AND hospital_clinic_id = '$model->hospital_id' AND from_time = '$startDate' AND to_time = '$endDate';";
            $result = $con->createCommand($sql)->execute();
            return $result;
        }
       
    }
    public function viewDoctorSchedule($con, $hospital, $doctor)
    {
        $query = "SELECT DISTINCT daytime.from_time as start,
        daytime.to_time as end,
        'bg-success' as className 
            FROM slot_day_time_mapping daytime
            WHERE daytime.hospital_clinic_id = '$hospital' AND 
            daytime.doctor_id = '$doctor'";
        $result = $con->createCommand($query)->queryAll();
        return $result;
    }

    public function createDoctorSchedule($con, $model)
    {
        $check = "SELECT count(doctor_id) cnt FROM schedule WHERE doctor_id = '$model->doctor_id' AND hospital_id = '$model->hospital_id';";
        $count = $con->createCommand($check)->queryOne();
        if($count['cnt'] > 0){
            return true;
        }else
        {
            $sql = "INSERT INTO schedule(investigation_id,doctor_id,hospital_id)values('0','$model->doctor_id','$model->hospital_id');";
            $result = $con->createCommand($sql)->execute();
            return $result;
        }

    }
    public function deleteDoctorSchedule($model, $startDate, $endDate)
    {
        $con = \Yii::$app->db;
        $date = date('Y-m-d',strtotime($endDate));
        $slotQuery = "SELECT id from slot_day_mapping WHERE doctor_id = '$model->investigation_id' AND hospital_clinic_id = '$model->hospital_id'
        AND day = '$date';";
        $slotResult = $con->createCommand($slotQuery)->queryOne();
        if($slotResult)
        {
            $slotId = $slotResult['id'];
            $sql = "DELETE FROM slot_day_time_mapping WHERE slot_day_id = '$slotId' AND hospital_clinic_id = '$model->hospital_id' AND doctor_id = '$model->investigation_id' AND from_time = '$startDate' AND to_time = '$endDate';";
            $result = $con->createCommand($sql)->execute();
            return $result;
        }
       
    }


    public function getTimeSlotOptions(){
        $con = \Yii::$app->db;
        $sql = "SELECT tmeSlot FROM hospital_time_slot_setting";
        $slotResult = $con->createCommand($sql)->queryAll();
        return $slotResult;
    }

    public function getDoctorAmount($doc){
        $con = \Yii::$app->db;
        $hospital = Yii::$app->user->identity->id;
        $sql = "SELECT amount FROM doctor_schedule_mapping WHERE doctor_id = '$doc'  AND hospital_clinic_id = '$hospital'";
        $result = $con->createCommand($sql)->queryAll();
        return (!empty($result)) ? $result[0]['amount'] : '0.00';
    }

    public function getDoctorDaySlotDetails($doc){
        $con = \Yii::$app->db;
        $sql = "SELECT day.doctor_id, day.hospital_id,day.day_id as dayId, GROUP_CONCAT(docTime.slot_time SEPARATOR ',') as slots FROM doctor_hospital_day_mapping day JOIN doctor_slot_time_mapping docTime ON day.id = docTime.day_mapping_id WHERE day.doctor_id = '$doc' GROUP BY docTime.day_mapping_id";
        $slotResult = $con->createCommand($sql)->queryAll();
        return $slotResult;
    }
    




    
}
