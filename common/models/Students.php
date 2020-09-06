<?php

namespace common\models;

use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "students".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $password
 * @property string $confirm_password
 * @property string $user_id
 * @property string $dob
 * @property string $native_place
 * @property string $parent_email
 * @property string $native_town
 * @property integer $education
 * @property integer $education_cat
 * @property integer $mbbs_year
 * @property integer $status
 * @property string $profile_info
 * @property string $cod
 * @property string $uod
 * @property string $address
 * @property string $field1
 * @property integer $state
 * @property integer $country
 * @property integer $role
 * @property string $auth_key
 * @property string $password_reset_token
 * @property string $college
 * @property string $profile_image
 * @property string $field4
 */
class Students extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public $password_before;

        public static function tableName() {
                return 'students';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                    [['first_name', 'last_name', 'user_id', 'dob', 'role'], 'required'],
                    [['dob', 'cod', 'uod'], 'safe'],
                    [['education', 'education_cat', 'mbbs_year', 'status', 'state', 'country', 'role'], 'integer'],
                    [['address'], 'string'],
                    ['user_id', 'email', 'message' => 'This email  is not a valid one.'],
                    ['user_id', 'uniquechk'],
                    [['first_name', 'last_name', 'user_id', 'parent_email', 'profile_info'], 'string', 'max' => 150],
                    [['password', 'password_reset_token', 'college', 'profile_image'], 'string', 'max' => 255],
                    [['native_place', 'native_town'], 'string', 'max' => 200],
                    [['field1', 'created_by'], 'string', 'max' => 45],
                    [['auth_key'], 'string', 'max' => 32],
                        //['confirm_password', 'compare', 'compareAttribute' => 'password', 'message' => "Passwords don''''''t match"],
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
                    'confirm_password' => 'Confirm Password',
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
                    'field1' => 'Field1',
                    'state' => 'State',
                    'country' => 'Country',
                    'role' => 'Role',
                    'auth_key' => 'Auth Key',
                    'password_reset_token' => 'Password Reset Token',
                    'college' => 'College',
                    'profile_image' => 'Profile Image',
                    'created_by' => 'Created By',
                ];
        }

        public function search($params) {
                $query = Students::find();

                // add conditions that should always apply here

                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                ]);

                $this->load($params);

                if (!$this->validate()) {
                        // uncomment the following line if you do not want to return any records when validation fails
                        // $query->where('0=1');
                        return $dataProvider;
                }

                // grid filtering conditions
//        $query->andFilterWhere([
//            'id' => $this->id,
//            'cb' => $this->cb,
//            'ub' => $this->ub,
//            'doc' => $this->doc,
//            'dou' => $this->dou,
//            'status' => $this->status,
//        ]);
//        $query->andFilterWhere(['like', 'question', $this->question])
//            ->andFilterWhere(['like', 'answer', $this->answer]);
//        return $dataProvider;
        }

        public function upload($file, $id, $name) {
                if (\yii::$app->basePath . '/../uploads') {
                        chmod(\yii::$app->basePath . '/../uploads', 0777);

                        if (!is_dir(\yii::$app->basePath . '/../uploads/student/')) {
                                mkdir(\yii::$app->basePath . '/../uploads/student/');
                                chmod(\yii::$app->basePath . '/../uploads/student/', 0777);
                        }
                        if (!is_dir(\yii::$app->basePath . '/../uploads/student/' . $id . '/')) {
                                mkdir(\yii::$app->basePath . '/../uploads/student/' . $id . '/');
                                chmod(\yii::$app->basePath . '/../uploads/student/' . $id . '/', 0777);
                        }

                        if ($file->saveAs(\yii::$app->basePath . '/../uploads/student/' . $id . '/' . $name . '.' . $file->extension))
                                chmod(\yii::$app->basePath . '/../uploads/student/' . $id . '/' . $name . '.' . $file->extension, 0777);

                        return true;
                }






//                        $this->image->saveAs('uploads/' . $this->image->baseName . '.' . $this->image->extension);
//                        return true;
        }

        public function uniquechk($attributes, $params) {
                if (isset($this->user_id) && $this->user_id !== "") {
                        if ($this->isNewRecord) {
                                $stddetails = Students::find()->where(['user_id' => $this->user_id])->one();
                                if (count($stddetails) > 0) {
                                        $this->addError('user_id', 'username already in use');
                                }
                        } else {
                                $stddetails = Students::find()
                                        ->where(['user_id' => $this->user_id])
                                        ->andWhere('<>', 'id', $this->id)
                                        ->one();
                                if (count($stddetails) > 0) {
                                        $this->addError('user_id', 'username already in use');
                                }
                        }
                }
        }

}
