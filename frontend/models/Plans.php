<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "plans".
 *
 * @property integer $plan
 * @property string $plan_name
 * @property integer $periods
 * @property integer $status
 * @property string $cod
 * @property string $uod
 * @property integer $courses
 * @property string $image
 * @property integer $price
 */
class Plans extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'plans';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                    [['plan', 'plan_name', 'periods', 'status', 'cod', 'uod', 'courses', 'price'], 'required'],
                    [['plan', 'periods', 'status', 'courses', 'price'], 'integer'],
                    [['cod', 'uod'], 'safe'],
                    [['plan_name', 'image'], 'string', 'max' => 150],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'plan' => 'Plan',
                    'plan_name' => 'Plan Name',
                    'periods' => 'Periods',
                    'status' => 'Status',
                    'cod' => 'Cod',
                    'uod' => 'Uod',
                    'courses' => 'Courses',
                    'image' => 'Image',
                    'price' => 'Price',
                ];
        }

        public function getPlans() {
                return new \yii\data\ActiveDataProvider([
                    'query' => Plans::find()
                            ->Where(['status' => 1]),
                    'pagination' => [
                        'pageSize' => 5,
                    ],
                ]);
        }

}
