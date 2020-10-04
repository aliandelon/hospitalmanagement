<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "investigations".
 *
 * @property int $id
 * @property int $mst_id
 * @property string $investigation_name
 * @property int $status
 * @property string $created_on
 * @property int $created_by_type This field is for saving if the item is created by an admin or any hospital or clinic 1:admin,2:hospital/clinic
 */
class Investigations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'investigations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mst_id', 'investigation_name', 'status', 'created_by_type'], 'required'],
            [['mst_id', 'status', 'created_by_type'], 'integer'],
            [['created_on'], 'safe'],
            [['investigation_name'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'mst_id' => Yii::t('app', 'Category'),
            'investigation_name' => Yii::t('app', 'Investigation Name'),
            'status' => Yii::t('app', 'Status'),
            'created_on' => Yii::t('app', 'Created On'),
            'created_by_type' => Yii::t('app', 'Created By Type'),
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'mst_id']);
    }

    public function getInvestigationCount()
    {

        $con = \Yii::$app->db;
        $query = "SELECT count(id) as count FROM investigations WHERE status='1'";
        $result = $con->createCommand($query)->queryAll();
        return $result[0]['count'];
    }

    public function getInvestigationMonthwiseCount()
    {

        $con = \Yii::$app->db;
        $query = "SELECT DATE_FORMAT(app_date, '%Y-%m') as period,count(id) as Investigation FROM `appointments` WHERE (app_date >= '".date('Y')."-01-01' OR app_date <= '".date('Y')."-12-31')  AND appointment_type = 0 GROUP BY MONTH(app_date) ORDER BY MONTH(app_date)";
        $result = $con->createCommand($query)->queryAll();
        return json_encode($result);
    }
}
