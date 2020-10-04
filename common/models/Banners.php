<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "banners".
 *
 * @property integer $id
 * @property string $name
 * @property string $expiry_date
 * @property string $image
 * @property integer $hospital_clinic_id
 * @property integer $sort_order
 * @property integer $status
 */
class Banners extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banners';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'expiry_date', 'image', 'hospital_clinic_id', 'sort_order', 'status'], 'required','on'=>'oncreate'],
            
            [['name', 'expiry_date', 'hospital_clinic_id', 'sort_order', 'status'], 'required','on'=>'onupdate'],
            [['expiry_date'], 'safe'],
            [['image'], 'string'],
            [['hospital_clinic_id', 'sort_order', 'status'], 'integer'],
            [['name'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'expiry_date' => 'Expiry Date',
            'image' => 'Image',
            'hospital_clinic_id' => 'Select Hospital',
            'sort_order' => 'Sort Order',
            'status' => 'Status',
        ];
    }

    public function upload($file, $id, $name) {

       $targetFolder = \yii::$app->basePath . '/../uploads/banners/' . $id . '/';
        if (!file_exists($targetFolder)) {
            mkdir($targetFolder, 0777, true);
            chmod($targetFolder,0777);
        }
        if ($file->saveAs($targetFolder . $name . '.' . $file->extension)) {
            chmod($targetFolder . $name . '.' . $file->extension,0777);
            return true;
        } else {
            return false;
        }
    }

    public function getBannerCount()
    {

        $con = \Yii::$app->db;
        $query = "SELECT count(id) as count FROM banners WHERE status='1'";
        $result = $con->createCommand($query)->queryAll();
        return $result[0]['count'];
    }
}
