<?php

namespace frontend\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
//use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "students".
 *
 * @property integer $stud_id
 * @property string $first_name
 * @property string $last_name
 * @property string $password
 * @property string $user_id
 * @property string $dob
 * @property integer $native_place
 * @property string $parent_email
 * @property integer $native_town
 * @property integer $education
 * @property integer $education_cat
 * @property integer $mbbs_year
 * @property integer $status
 * @property string $profile_info
 * @property string $cod
 * @property string $uod
 * @property string $field4
 * @property integer $role
 * @property integer college
 * @property integer profile_image
 * * @property string multi_token
 */
class Students extends \yii\db\ActiveRecord implements IdentityInterface {

        /**
         * @inheritdoc
         */
        const STATUS_DELETED = 0;
        const STATUS_ACTIVE = 10;
        const STATUS_REGISTER = 1;
        const STATUS_DEFAULT = 1;

        public $con_password;
        public $created_at;
        public $updated_at;

        public static function tableName() {
                return 'students';
        }

        /**
         * @inheritdoc
         */
        public function behaviors() {
                return [
                    TimestampBehavior::className(),
                ];
        }

        public function rules() {
                return [
                    [['first_name', 'last_name', 'user_id', 'password', 'dob', 'parent_email', 'native_place', 'profile_info', 'mobile_number','college'], 'trim'],
                    [['first_name', 'last_name', 'user_id', 'password', 'dob', 'parent_email', 'native_place', 'profile_info', 'college',], 'default'],
                    [['first_name', 'last_name', 'password', 'dob', 'role', 'state' ,'mobile_number','college'], 'required'],
                    [['user_id'], 'required', 'message' => 'Email canot be blank.'],
                    ['user_id', 'email', 'message' => 'This email  is not a valid one.'],
                    ['user_id', 'unique', 'message' => 'This email  has already been registred.'],
                    ['parent_email', 'email', 'message' => 'This email  is not a valid one.'],
                    [['dob', 'cod', 'uod', 'multi_token'], 'safe'],
                    [['education', 'education_cat', 'mbbs_year', 'status', 'role', 'state', 'country'], 'integer'],
                    [['first_name', 'last_name', 'user_id', 'parent_email', 'profile_info', 'college'], 'string', 'max' => 150],
                    [['password', 'con_password'], 'string', 'min' => 6, 'max' => 255],
                    ['status', 'default', 'value' => self::STATUS_ACTIVE],
                    ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_REGISTER, self::STATUS_DELETED]],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'first_name' => 'First Name',
                    'last_name' => 'Last Name',
                    'password' => 'Password',
                    'user_id' => 'User ID',
                    'dob' => 'Dob',
                    'native_place' => 'Native Place',
                    'parent_email' => 'Parent Email',
                    'native_town' => 'Native Town',
                    'education' => 'Education',
                    'education_cat' => 'Education Cat',
                    'mbbs_year' => 'Mbbs Year',
                    'status' => 'Status',
                    'profile_info' => 'Profile Info',
                    'cod' => 'Cod',
                    'uod' => 'Uod',
                    'address' => 'Address',
                    'mobile_number' => 'Mobile Number',
                    'role' => 'Role',
                    'state' => 'State',
                    'country' => 'Country',
                    'con_password' => 'Confirm Password',
                    'profile_image' => 'Profile Image',
                    'college' => 'College',
                    'multi_token' => 'Multi Token'
                ];
        }

        public static function findIdentity($id) {
                return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
        }

        public static function findIdentityByAccessToken($token, $type = null) {
                throw new NotSupportedException('

                "findIdentityByAccessToken"  is not implemented.

                ');
        }

        public function register() {
                if (!$this->validate()) {
                        return null;
                }
                $this->setPassword($this->password);
                $this->generateAuthKey();
                return $this->save() ? $this : null;
        }

        public function setPassword($password) {
                $this->password = Yii::$app->security->generatePasswordHash($password);
        }

        public function generateAuthKey() {
                $this->auth_key = Yii::$app->security->generateRandomString();
        }

        public function generatePasswordResetToken() {
                echo $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
        }

        public function removePasswordResetToken() {
                $this->password_reset_token = null;
        }

        public function validatePassword($password) {
                return Yii::$app->security->validatePassword($password, $this->password);
        }

        public function validateAuthKey($authKey) {
                return $this->getAuthKey() === $authKey;
        }

        public function getAuthKey() {
                return $this->auth_key;
        }

        public function getId() {
                return $this->getPrimaryKey();
        }

        public static function isPasswordResetTokenValid($token) {
                if (empty($token)) {
                        return false;
                }

                $timestamp = (int) substr($token, strrpos($token, '_') + 1);
                $expire = Yii::$app->params['user.passwordResetTokenExpire'];
                return $timestamp + $expire >= time();
        }

        public static function findByPasswordResetToken($token) {
                if (!static::isPasswordResetTokenValid($token)) {
                        return null;
                }
                return static::findOne(['password_reset_token' => $token, 'status' => self::STATUS_ACTIVE,]);
        }

        public static function findByUsername($username) {
                return static::findOne(['user_id' => $username, 'status' => self::STATUS_ACTIVE]);
        }

        public function passwordStrength($attributes, $params) {
                if (!preg_match('/^(? = .*\d

)(? = .*[

                A-Za

                -z])   [ 0-9

                A-Za-

                z!@#$%]{8,12}$/', $$this->password)) {
                        $this->addError
                                ('password', 'Password should only contain atlest one alphabets,number,special character');
                }
        }

        public function loadPost
        () {
                return new ActiveDataProvider([
                    'query' => Posts::find()->where(['status' => 0])->orderBy('post_id DESC'),
                    'pagination' => [
                        'pageSize' => 3,
                    ],
                    'sort' => ['defaultOrder' => ['cod' => SORT_DESC]]
                ]);
        }

}
