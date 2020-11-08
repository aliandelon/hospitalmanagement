<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sloat_time_mapping".
 *
 * @property integer $id
 * @property integer $master_id
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
            [['master_id', 'slot_time'], 'required'],
            [['master_id'], 'integer'],
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
            'master_id' => 'Master ID',
            'slot_time' => 'Slot Time',
        ];
    }
    public function timeSave($model){

    $con = \Yii::$app->db;
    $sql = "INSERT into sloat_time_mapping(master_id,slot_time)VALUES('$model->master_id','$model->slot_time') ON DUPLICATE KEY UPDATE  id= VALUES(id), master_id=VALUES(master_id),slot_time=VALUES(slot_time);";
        $result = $con->createCommand($sql)->execute();
        return $result;
}
}
