<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "appointments".
 *
 * @property integer $id
 * @property integer $patient_id
 * @property integer $doctor_id
 * @property integer $investigation_id
 * @property integer $slot_day_time_mapping_id
 * @property integer $hospital_clinic_id
 * @property string $app_date
 * @property string $app_time
 * @property integer $appointment_type
 */
class Appointments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'appointments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['patient_id', 'investigation_id', 'slot_day_time_mapping_id', 'hospital_clinic_id', 'app_date', 'app_time'], 'required'],
            [['patient_id', 'doctor_id', 'investigation_id', 'slot_day_time_mapping_id', 'hospital_clinic_id', 'appointment_type'], 'integer'],
            [['app_date'], 'safe'],
            [['app_time'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            // 'id' => 'ID',
            'patient_id' => 'Patient ID',
            'doctor_id' => 'Doctor ID',
            'investigation_id' => 'Investigation ID',
            'slot_day_time_mapping_id' => 'Slot Day Time Mapping ID',
            'hospital_clinic_id' => 'Hospital Clinic ID',
            // 'app_date' => 'App Date',
            // 'app_time' => 'App Time',
            // 'appointment_type' => 'Appointment Type',
        ];
    }

    public function getAppointmentCount()
    {

        $con = \Yii::$app->db;
        $query = "SELECT count(id) as count FROM appointments WHERE 1";
        $result = $con->createCommand($query)->queryAll();
        return $result[0]['count'];
    }

    public function getTopRatedHospitals($fDate,$eDate){
        $con = \Yii::$app->db;
        $query = "SELECT hos.name,COALESCE(hos.city,CONCAT(hos.state,',',hos.city),hos.state) as place,COUNT(app.id) as count FROM appointments app LEFT JOIN hospital_clinic_details hos ON hos.user_id = app.hospital_clinic_id WHERE app.app_date >= '2020-09-01' OR app.app_date <= '2020-09-30' GROUP BY app.hospital_clinic_id ORDER BY count DESC";
        $result = $con->createCommand($query)->queryAll();
        return $result;
    }

    public function getTopRatedDoctors($fDate,$eDate){
        $con = \Yii::$app->db;
        $query = "SELECT doc.name,hos.name as  hosName,COUNT(app.id) as count FROM appointments app LEFT JOIN hospital_clinic_details hos ON hos.user_id = app.hospital_clinic_id LEFT JOIN doctors_details doc ON app.doctor_id = doc.id WHERE (app.app_date >= '2020-09-01' OR app.app_date <= '2020-09-30') AND appointment_type = 1 GROUP BY app.doctor_id ORDER BY count DESC";
        $result = $con->createCommand($query)->queryAll();
        return $result;
    }

    public function getTopRatedInvestigations($fDate,$eDate){
        $con = \Yii::$app->db;
        $query = "SELECT inv.investigation_name,hos.name as hosName,COUNT(app.id) as count FROM appointments app LEFT JOIN hospital_clinic_details hos ON hos.user_id = app.hospital_clinic_id LEFT JOIN investigations inv ON app.investigation_id = inv.id WHERE (app.app_date >= '2020-09-01' OR app.app_date <= '2020-09-30') AND appointment_type = 0 GROUP BY app.investigation_id ORDER BY count DESC";
        $result = $con->createCommand($query)->queryAll();
        return $result;
    }

    public function getOurAppointmentCount()
    {

        $con = \Yii::$app->db;
        $query = "SELECT count(id) as count FROM appointments WHERE hospital_clinic_id = ".Yii::$app->user->identity->id;
        $result = $con->createCommand($query)->queryAll();
        return $result[0]['count'];
    }

    public function getOurPatientsCount()
    {

        $con = \Yii::$app->db;
        $query = "SELECT count(count) as count FROM (SELECT distinct patient_id as count FROM appointments WHERE hospital_clinic_id = ".Yii::$app->user->identity->id.") as tables";
        $result = $con->createCommand($query)->queryAll();
        return $result[0]['count'];
    }

    public function getInvestigationSummary($hospital, $limit)
    {

        $con = \Yii::$app->db;
        $query = "SELECT count(app.investigation_id) as invIdCount, inv.investigation_name as name FROM hospital_investigation_mapping map LEFT JOIN investigations inv ON inv.id = map.investigation_id LEFT JOIN appointments app ON app.investigation_id = map.investigation_id WHERE map.hospital_clinic_id = '$hospital' GROUP BY app.investigation_id ORDER BY inv.investigation_name";
        if($limit){
            $query .= ' limit '. $limit;
        }
        $result = $con->createCommand($query)->queryAll();
        return $result;
    }    

}
