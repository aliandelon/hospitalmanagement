<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "admin_details".
 *
 * @property int $id
 * @property int $admin_id admin_id maps with id in login table
 * @property string $name
 * @property string $email
 * @property string $phone_number
 * @property string $address
 * @property int $role_id
 * @property int $status
 * @property string profile_image
 */
class AdminDetails extends \yii\db\ActiveRecord
{
    public $password;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['admin_id', 'name', 'email', 'phone_number', 'address', 'razorpay_id', 'razorpay_name', 'status','password'], 'required'],
            ['profile_image', 'image', 'minWidth' => 100, 'maxWidth' => 610,'minHeight' => 100, 'maxHeight' => 610, 'extensions' => 'jpg, gif, png', 'maxSize' => 1024 * 1024 * 2],
            [['admin_id', 'role_id', 'status'], 'integer'],
            [['address'], 'string'],
            [['name'], 'string', 'max' => 150],
            [['email'], 'string', 'max' => 250],
            ['email', 'unique'],
            ['email', 'email'],
            [['password','profile_image'],'safe'],
            [['phone_number'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'admin_id' => Yii::t('app', 'Admin ID'),
            'name' => Yii::t('app', 'Name'),
            'email' => Yii::t('app', 'Email'),
            'phone_number' => Yii::t('app', 'Phone Number'),
            'address' => Yii::t('app', 'Address'),
            'razorpay_id' => Yii::t('app', 'Razorpay Id'),
            'razorpay_name' => Yii::t('app', 'Razorpay Name'),
            'role_id' => Yii::t('app', 'Role'),
            'status' => Yii::t('app', 'Status'),
            'profile_image' => Yii::t('app', 'Profile Image'),
          
        ];
    }
    public function upload($file, $id, $name) {

       $targetFolder = \yii::$app->basePath . '/../uploads/admin-details/' . $id . '/';
        if (!file_exists($targetFolder)) {
            mkdir($targetFolder, 0777, true);
        }
        if ($file->saveAs($targetFolder . $name . '.' . $file->extension)) {
            return true;
        } else {
            return false;
        }
    }
}
