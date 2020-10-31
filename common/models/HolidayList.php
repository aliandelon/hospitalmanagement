<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "holiday_list".
 *
 * @property integer $id
 * @property integer $investigation_id
 * @property integer $hospital_id
 * @property string $reason
 * @property string $holiday_date
 * @property string $created_on
 */
class HolidayList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'holiday_list';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['investigation_id', 'hospital_id', 'reason', 'holiday_date'], 'required'],
            [['id', 'investigation_id', 'hospital_id'], 'integer'],
            [['reason'], 'string'],
            [['holiday_date', 'created_on'], 'safe'],
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
            'hospital_id' => 'Hospital ID',
            'reason' => 'Reason',
            'holiday_date' => 'Holiday Date',
            'created_on' => 'Created On',
        ];
    }

    public function addEvents($con, $model)
    {
         $query = "INSERT INTO holiday_list (investigation_id, hospital_id, holiday_flag,reason, holiday_date) VALUES ('$model->investigation_id', '$model->hospital_id',$model->holiday_flag, '$model->reason', '$model->holiday_date') ON DUPLICATE KEY UPDATE investigation_id = VALUES(investigation_id), hospital_id = VALUES(hospital_id), holiday_flag = VALUES(holiday_flag), reason = VALUES(reason), holiday_date = VALUES(holiday_date), created_on = VALUES(created_on)";
        $result = $con->createCommand($query)->execute();
        return $result;
    }

    public function viewEvents($con, $hospital)
    {
         $query = "SELECT reason as title, holiday_date  as start,'bg-danger' as className FROM holiday_list WHERE hospital_id = '$hospital'";
        $result = $con->createCommand($query)->queryAll();
        return $result;
    }

    public function viewInvestigations($con)
    {
         $query = "SELECT id, investigation_name as name FROM investigations";
        $result = $con->createCommand($query)->queryAll();
        return $result;
    }

    public function viewLeaveDoctors($con,$hospital)
    {
        $date=date("Y-m-d");
         $query = "SELECT doc.name as name,doc.id as id, doc.profile_image as image, DATE_FORMAT(hlist.holiday_date, '%d-%m-%Y') as leaveDate FROM holiday_list hlist JOIN  doctors_details doc ON hlist.doctor_id = doc.id WHERE hospital_id = '$hospital' AND doctor_id != 0 AND hlist.holiday_date = '$date' ORDER BY hlist.holiday_date ASC";
        
        $result = $con->createCommand($query)->queryAll();
        return $result;
    }

     public function viewLeaveDoctorsAjax($con,$hospital,$startDate,$endDate)
        {
        $query = "SELECT doc.name as name,doc.id as id, doc.profile_image as image, DATE_FORMAT(hlist.holiday_date, '%d-%m-%Y') as leaveDate FROM holiday_list hlist JOIN  doctors_details doc ON hlist.doctor_id = doc.id WHERE hospital_id = '$hospital' AND doctor_id != 0 AND hlist.holiday_date >= '$startDate' AND hlist.holiday_date<='$endDate' ORDER BY hlist.holiday_date ASC";
        
            $result = $con->createCommand($query)->queryAll();
        return $result;
    }

    public function publish($hospital)
    {
         $con = \Yii::$app->db;
         $query = "SELECT IF((hos > 0 AND doc > 0),'1','0') as flag FROM (SELECT IF(COUNT(hos.id) > 0, '1', '0') as hos,(SELECT IF(COUNT(doc.id) > 0, '1', '0') as doc FROM doctors_details doc WHERE doc.hospital_clinic_id = '$hospital') as doc FROM hospital_investigation_mapping hos WHERE hos.hospital_clinic_id = '$hospital')AS result";
        $result = $con->createCommand($query)->queryAll();
        return $result;
    }
    public function published($flag,$hospital)
    {
        $con = \Yii::$app->db;
        $query = "UPDATE hospital_clinic_details SET publish_flag= '$flag' WHERE user_id = '$hospital'";
        $result = $con->createCommand($query)->execute();
        return $result;
    }
}
