<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "doctors_details".
 *
 * @property integer $id
 * @property integer $hospital_clinic_id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $gender
 * @property string $registration_no
 * @property integer $experience
 * @property string $profile_image
 * @property integer $specialty_id
 * @property string $qualifications
 * @property string $address
 * @property integer $status
 * @property string $created_on
 */
class DoctorsDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'doctors_details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hospital_clinic_id', 'name', 'email', 'phone', 'gender', 'registration_no', 'experience', 'profile_image', 'specialty_id', 'qualifications', 'address', 'status'], 'required'],
            [['hospital_clinic_id', 'experience', 'specialty_id', 'status'], 'integer'],
            [['profile_image', 'address'], 'string'],
            [['created_on'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['email'], 'string', 'max' => 250],
            [['phone'], 'string', 'max' => 20],
            [['gender'], 'string', 'max' => 1],
            [['registration_no'], 'string', 'max' => 50],
            [['qualifications'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hospital_clinic_id' => 'Hospital Clinic ID',
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'gender' => 'Gender',
            'registration_no' => 'Registration No',
            'experience' => 'Experience',
            'profile_image' => 'Profile Image',
            'specialty_id' => 'Specialty ID',
            'qualifications' => 'Qualifications',
            'address' => 'Address',
            'status' => 'Status',
            'created_on' => 'Created On',
        ];
    }

    public function viewDoctors($con, $hospital,$id='')
    {
         $query = "SELECT doc.id,doc.name as name,doc.profile_image as img,doc.qualifications,doc.registration_no,doc.phone,doc.gender,doc.email,doc.address,spec.name as spectial FROM doctors_details doc LEFT JOIN doctor_specialty_mst spec ON doc.specialty_id = spec.id WHERE doc.hospital_clinic_id = '$hospital'";
         if($id){
            $query .= " AND doc.id = $id";
         }
        $result = $con->createCommand($query)->queryAll();
        return $result;
    }

    public function upload($file, $id, $name) {

       $targetFolder = \yii::$app->basePath . '/../uploads/doctors/';
        if (!file_exists($targetFolder)) {
            mkdir($targetFolder, 0777, true);
        }
        if ($file->saveAs($targetFolder . $name . '.' . $file->extension)) {
            return true;
        } else {
            return false;
        }
    } 

    public function getDocCount($status='')
    {

        $con = \Yii::$app->db;
        $query = "SELECT count(id) as count FROM doctors_details WHERE 1";
         if($status){
            $query .= " AND status = '$status'";
         }
        $result = $con->createCommand($query)->queryAll();
        return $result[0]['count'];
    }

    public function getDoctorMonthwiseCount()
    {

        $con = \Yii::$app->db;
        $query = "SELECT DATE_FORMAT(app_date, '%Y-%m') as period,count(id) as DoctorAppointments FROM `appointments` WHERE (app_date >= '".date('Y')."-01-01' OR app_date <= '".date('Y')."-12-31')  AND appointment_type = 1 GROUP BY MONTH(app_date) ORDER BY MONTH(app_date)";
        $result = $con->createCommand($query)->queryAll();
        return json_encode($result);
    }
}
