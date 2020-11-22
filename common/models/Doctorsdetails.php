<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "doctors_details".
 *
 * @property integer $id
 * @property integer $hospital_clinic_id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $gender
 * @property string $registration_no
 * @property integer $experience
 * @property string $profile_image
 * @property integer $specialty_id
 * @property string $qualifications
 * @property string $address
 * @property integer $status
 * @property string $created_on
 */
class Doctorsdetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'doctors_details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hospital_clinic_id', 'name', 'email', 'phone', 'gender', 'registration_no', 'experience', 'profile_image', 'specialty_id', 'qualifications', 'address', 'status'], 'required'],
            [['hospital_clinic_id', 'experience', 'specialty_id', 'status'], 'integer'],
            [['profile_image', 'address'], 'string'],
            [['created_on'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['email'], 'string', 'max' => 250],
            [['phone'], 'string', 'max' => 20],
            [['gender'], 'string', 'max' => 1],
            [['registration_no'], 'string', 'max' => 50],
            [['qualifications'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hospital_clinic_id' => 'Hospital Clinic ID',
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'gender' => 'Gender',
            'registration_no' => 'Registration No',
            'experience' => 'Experience',
            'profile_image' => 'Profile Image',
            'specialty_id' => 'Specialty ID',
            'qualifications' => 'Qualifications',
            'address' => 'Address',
            'status' => 'Status',
            'created_on' => 'Created On',
        ];
    }
}
