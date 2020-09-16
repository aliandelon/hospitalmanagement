<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "patient_details".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property string $profile_image
 * @property string $address
 * @property integer $age
 * @property integer $gender
 * @property string $state
 * @property string $district
 * @property string $city
 * @property string $area
 * @property integer $status
 * @property string $created_on
 */
class PatientDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'patient_details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'email', 'phone', 'profile_image', 'address', 'age', 'gender', 'state', 'district', 'city', 'area', 'status'], 'required'],
            [['profile_image', 'address'], 'string'],
            [['age', 'gender', 'status'], 'integer'],
            [['created_on'], 'safe'],
            [['first_name', 'last_name'], 'string', 'max' => 150],
            [['email', 'state', 'district', 'city', 'area'], 'string', 'max' => 250],
            [['phone'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'profile_image' => 'Profile Image',
            'address' => 'Address',
            'age' => 'Age',
            'gender' => 'Gender',
            'state' => 'State',
            'district' => 'District',
            'city' => 'City',
            'area' => 'Area',
            'status' => 'Status',
            'created_on' => 'Created On',
        ];
    }
}
