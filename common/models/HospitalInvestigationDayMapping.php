<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "hospital_investigation_day_mapping".
 *
 * @property integer $id
 * @property integer $hospital_id
 * @property integer $category_id
 * @property integer $investigation_id
 * @property integer $day_id
 */
class HospitalInvestigationDayMapping extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hospital_investigation_day_mapping';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hospital_id', 'category_id', 'investigation_id', 'day_id'], 'required'],
            [['hospital_id', 'category_id', 'investigation_id', 'day_id'], 'integer'],
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
            'category_id' => 'Category ID',
            'investigation_id' => 'Investigation ID',
            'day_id' => 'Day ID',
        ];
    }

public function daySave($model){
    $con = \Yii::$app->db;
     $sql1 = "SELECT * FROM hospital_investigation_day_mapping WHERE investigation_id = '$model->investigation_id' AND hospital_id = '$model->hospital_id' AND day_id = '$model->day_id'";
    $result = $con->createCommand($sql1)->queryAll();
    if(empty($result)){
        $sql = "INSERT into hospital_investigation_day_mapping(hospital_id,investigation_id,category_id,day_id)VALUES('$model->hospital_id','$model->investigation_id','$model->category_id','$model->day_id');";
        $result = $con->createCommand($sql)->execute();
        $id = Yii::$app->db->getLastInsertID();
    }else{
        $id = $result[0]['id'];
        $sql = "UPDATE hospital_investigation_day_mapping SET day_id = '$model->day_id', category_id = '$model->category_id' WHERE hospital_id = '$model->hospital_id' AND investigation_id = '$model->investigation_id' AND day_id = '$model->day_id'";
        $result = $con->createCommand($sql)->execute();
    }
    return $id;
    
    //     $result = $con->createCommand($sql)->execute();
    //     return $result;
    // $sql = "INSERT into hospital_investigation_day_mapping(hospital_id,investigation_id,category_id,day_id)VALUES('$model->hospital_id','$model->investigation_id','$model->category_id','$model->day_id') ON DUPLICATE KEY UPDATE id= VALUES(id), hospital_id=VALUES(hospital_id),investigation_id=VALUES(investigation_id),category_id=VALUES(category_id),day_id=VALUES(day_id);";
    //     $result = $con->createCommand($sql)->execute();
    //     $id = Yii::$app->db->getLastInsertID();
    //     return $id;
    }


}
