<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "hospital_clinic_details".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property integer $type
 * @property string $phone_number
 * @property string $email
 * @property integer $have_diagnostic_center
 * @property integer $master_hospital_id
 * @property integer $same_as_hospital_details_flag
 * @property string $address
 * @property integer $pincode
 * @property string $street1
 * @property string $street2
 * @property string $state
 * @property string $city
 * @property string $area
 * @property string $latitude
 * @property string $longitude
 * @property integer $package_id
 * @property integer $created_by
 * @property integer $status
 */
class HospitalClinicDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hospital_clinic_details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'name', 'type', 'phone_number', 'email', 'have_diagnostic_center', 'master_hospital_id', 'same_as_hospital_details_flag', 'address', 'pincode', 'street1', 'street2', 'state', 'city', 'area', 'latitude', 'longitude', 'package_id', 'created_by', 'status'], 'required'],
            [['user_id', 'type', 'have_diagnostic_center', 'master_hospital_id', 'same_as_hospital_details_flag', 'pincode', 'package_id', 'created_by', 'status'], 'integer'],
            [['address'], 'string'],
            [['name', 'city', 'area'], 'string', 'max' => 150],
            [['phone_number'], 'string', 'max' => 20],
            [['email', 'street1', 'street2', 'state', 'latitude', 'longitude'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'name' => 'Name',
            'type' => 'Type',
            'phone_number' => 'Phone Number',
            'email' => 'Email',
            'have_diagnostic_center' => 'Have Diagnostic Center',
            'master_hospital_id' => 'Master Hospital ID',
            'same_as_hospital_details_flag' => 'Same As Hospital Details Flag',
            'address' => 'Address',
            'pincode' => 'Pincode',
            'street1' => 'Street1',
            'street2' => 'Street2',
            'state' => 'State',
            'city' => 'City',
            'area' => 'Area',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'package_id' => 'Package ID',
            'created_by' => 'Created By',
            'status' => 'Status',
        ];
    }
}
