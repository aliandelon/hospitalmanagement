<?php

namespace frontend\models;

use yii\base\Model;

/**
 * Signup form
 */
class Studying extends Model {

        public $year;
        public $sem;

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                    [['year', 'sem'], 'required'],
                ];
        }

        public function attributeLabels() {
                return [
                    'year' => 'Year',
                    'sem' => 'Semester'
                ];
        }

        /**
         * Signs user up.
         *
         * @return User|null the saved model or null if saving fails
         */
}
