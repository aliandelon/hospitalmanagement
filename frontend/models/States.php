<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "states".
 *
 * @property integer $Id
 * @property integer $country_id
 * @property string $state_name
 * @property integer $status
 *
 * @property Countries $country
 */
class States extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'states';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                    [['country_id', 'state_name'], 'required'],
                    [['country_id', 'status'], 'integer'],
                    [['state_name'], 'string', 'max' => 100],
                    [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['country_id' => 'id']],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'country_id' => 'Country ID',
                    'state_name' => 'State Name',
                    'status' => 'Status',
                ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getCountry() {
                return $this->hasOne(Countries::className(), ['id' => 'country_id']);
        }

}
