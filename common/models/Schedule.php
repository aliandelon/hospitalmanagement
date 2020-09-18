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
            [['investigation_id', 'hospital_id', 'doctor_id','amount'], 'required'],
            [['id', 'investigation_id', 'hospital_id', 'doctor_id', 'sunday_holiday', 'status'], 'integer'],
            [['created_on','amount'], 'safe'],
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
        return $this->hasOne(HospitalClinicDetails::class, ['id' => 'hospital_id']);
    }

    public function getInvestigations()
    {
        return $this->hasOne(Investigations::class, ['id' => 'investigation_id']);
    }

    public function checkScheduleExist($con, $model)
    {
        
        $query = "SELECT count(*)cnt from  schedule where investigation_id='$model->investigation_id' and hospital_id = '$model->hospital_id' AND doctor_id = $model->doctor_id AND status =1;";
        $result = $con->createCommand($query)->queryOne();
        return $result['cnt'];
    }
}
