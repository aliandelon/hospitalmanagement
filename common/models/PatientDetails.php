<?php

namespace common\models;

use Yii;
use yii\web\IdentityInterface;


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
class PatientDetails extends \yii\db\ActiveRecord implements IdentityInterface
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

    public static function findIdentityByAccessToken($token, $type = null)
    {
        //throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
        // foreach (self::$users as $user) {
        //     if ($user['id'] === (string) $token->getClaim('uid')) {
        //         return new static($user);
        //     }
        // }
        $user = PatientDetails::find()->select('id')->where(['id'=>(string) $token->getClaim('uid')])->one();
        if(!empty($user))
        {
            return new static($user);
        }else{
            return false;
        }
    }
     /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * @inheritdoc
     */
    

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::find()
        ->where([
            'email' => $username,
            'type' => [10,1],
        ])
        ->one();
        // return static::find()->where(['email' => $username])->andWhere(['N', 'type', [10,1]])->one();
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($typepassword,$savepassword)
    {   
        if(Yii::$app->getSecurity()->hashData($typepassword , '123') == $savepassword){
            return true;
        }else{
            return false;
        }
        // return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}
