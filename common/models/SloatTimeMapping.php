<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sloat_time_mapping".
 *
 * @property integer $id
 * @property integer $investigation_mapping_id
 * @property string $slot_time
 */
class SloatTimeMapping extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sloat_time_mapping';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['investigation_mapping_id', 'slot_time'], 'required'],
            [['investigation_mapping_id'], 'integer'],
            [['slot_time'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'investigation_mapping_id' => 'Master ID',
            'slot_time' => 'Slot Time',
        ];
    }
    public function timeSave($model){

        $con = \Yii::$app->db;
        $sql1 = "SELECT * FROM sloat_time_mapping WHERE investigation_mapping_id = '$model->investigation_mapping_id' AND slot_time = '$model->slot_time'";
        $result = $con->createCommand($sql1)->queryAll();
        if(empty($result)){
            $sql = "INSERT into sloat_time_mapping(investigation_mapping_id,slot_time)VALUES('$model->investigation_mapping_id','$model->slot_time');";
            $result = $con->createCommand($sql)->execute();
            return sizeof($result);
        }else{
            return 0;
        }


    // $con = \Yii::$app->db;
    // $sql = "INSERT into sloat_time_mapping(investigation_mapping_id,slot_time)VALUES('$model->investigation_mapping_id','$model->slot_time') ON DUPLICATE KEY UPDATE  id= VALUES(id), investigation_mapping_id=VALUES(investigation_mapping_id),slot_time=VALUES(slot_time);";
    //     $result = $con->createCommand($sql)->execute();
        
}
}
