<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "student_plans".
 *
 * @property integer $id
 * @property integer $student_id
 * @property integer $plan_id
 * @property string $cod
 * @property string $start_date
 * @property string $expiry_date
 * @property string $uod
 * @property integer $status
 * @property integer $free_trial
 * @property string $free_start
 * @property string $free_end
 */
class StudentPlan extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public $student_name;
        public $student_email;
        public $price;

        public static function tableName() {
                return 'student_plans';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                    [['student_id', 'plan_id'], 'required'],
                    ['student_id', 'unique', 'message' => 'You have already choosed a plan. Please go  your account '],
                    [['student_id', 'plan_id', 'status', 'free_trial'], 'integer'],
                    [['cod', 'start_date', 'expiry_date', 'uod', 'free_start', 'free_end'], 'safe'],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'student_id' => 'Student',
                    'plan_id' => 'Plan',
                    'cod' => 'Cod',
                    'start_date' => 'Start Date',
                    'expiry_date' => 'Expiry Date',
                    'uod' => 'Uod',
                    'status' => 'Status',
                    'free_trial' => 'Free Trial',
                    'free_start' => 'Free Start',
                    'free_end' => 'Free End',
                    'student_name' => 'Name',
                    'student_email' => 'Email',
                ];
        }

        public function getPlandetails() {
                return $this->hasOne(Plans::className(), ['plan_id' => 'plan_id']);
        }

        public function getStudendetails() {
                return $this->hasOne(Students::className(), ['id' => 'student_id']);
        }

}
