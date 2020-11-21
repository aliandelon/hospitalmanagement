<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "hospital_investigation_mapping".
 *
 * @property integer $id
 * @property integer $investigation_id
 * @property integer $hospital_clinic_id
 * @property string $amount
 * @property string $duration
 * @property string $details
 * @property integer $status
 */
class HospitalInvestigationMapping extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hospital_investigation_mapping';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['investigation_id', 'hospital_clinic_id', 'amount', 'duration', 'status'], 'required'],
            [['investigation_id', 'hospital_clinic_id', 'status'], 'integer'],
            [['amount'], 'number'],
            [['duration','isHomeCollection'], 'safe'],
            [['details'], 'string'],
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
            'amount' => 'Amount',
            'duration' => 'Duration',
            'details' => 'Details',
            'status' => 'Status',
        ];
    }

    public function checkHospitalInvestigation($con, $model2)
    {
        $query = "SELECT * from  hospital_investigation_mapping where investigation_id='$model2->investigation_id' and hospital_clinic_id = '$model2->hospital_clinic_id' AND status =1;";
        $result = $con->createCommand($query)->queryOne();
        return $result;
    }

    public function deleteHospitalInvestigation($con, $model2)
    {
        $query = "DELETE from  hospital_investigation_mapping where investigation_id='$model2->investigation_id' and hospital_clinic_id = '$model2->hospital_clinic_id' AND status =1;";
        $result = $con->createCommand($query)->execute();
        return $result;
    }

    public function updateHospitalInvestigation($con, $model2)
    {
        $query = "UPDATE hospital_investigation_mapping SET amount = '$model2->amount' where investigation_id='$model2->investigation_id' and hospital_clinic_id = '$model2->hospital_clinic_id' AND status =1;";
        $result = $con->createCommand($query)->execute();
        return $result;
    }
    public function saveHospitalInvestigation($con,$model)
    {
        $query = "SELECT id from  hospital_investigation_mapping where investigation_id='$model->investigation_id' and hospital_clinic_id = '$model->hospital_clinic_id' AND status =1;";
        $result = $con->createCommand($query)->queryOne();
        if($result['id']){
             $query = "UPDATE hospital_investigation_mapping SET amount = '$model->amount',details = '$model->details',isHomeCollection='$model->isHomeCollection' where investigation_id='$model->investigation_id' and hospital_clinic_id = '$model->hospital_clinic_id' AND status =1;";
        $result = $con->createCommand($query)->execute();
        return true;
        }else{
            $sql = "INSERT into hospital_investigation_mapping(investigation_id,hospital_clinic_id,amount,duration,status,isHomeCollection,details)VALUES('$model->investigation_id','$model->hospital_clinic_id','$model->amount','30','1','$model->isHomeCollection','$model->details');";
            $result = $con->createCommand($sql)->execute();
            return $result;
        }

    }
public function getOurInvestigationCount()
    {

        $con = \Yii::$app->db;
        $query = "SELECT count(id) as count FROM hospital_investigation_mapping WHERE hospital_clinic_id = ".Yii::$app->user->identity->id." AND  status='1'";
        $result = $con->createCommand($query)->queryAll();
        return $result[0]['count'];
    }



public function modeleInsert($model){
    $con = \Yii::$app->db;
    $sql1 = "SELECT * FROM hospital_investigation_mapping WHERE investigation_id = '$model->investigation_id' AND hospital_clinic_id = '$model->hospital_clinic_id'";
    $result = $con->createCommand($sql1)->queryAll();
    if(sizeof($result) > 0){
        $sql = "UPDATE hospital_investigation_mapping SET amount = '$model->amount', details = '$model->details', isHomeCollection = '$model->isHomeCollection' WHERE status = 1 AND hospital_clinic_id = '$model->hospital_clinic_id' AND investigation_id = '$model->investigation_id'";
    }else{
        $sql = "INSERT into hospital_investigation_mapping(investigation_id,hospital_clinic_id,amount,duration,status,isHomeCollection,details)VALUES('$model->investigation_id','$model->hospital_clinic_id','$model->amount','30','1','$model->isHomeCollection','$model->details');";
    }
        $result = $con->createCommand($sql)->execute();
        return $result;
}

    
}
