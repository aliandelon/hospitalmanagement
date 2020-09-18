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
         $query = "INSERT INTO holiday_list (investigation_id, hospital_id, holiday_flag,reason, holiday_date) VALUES ('$model->investigation_id', '$model->hospital_id',$model->holiday_flag, '$model->reason', '$model->holiday_date');";
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

}
