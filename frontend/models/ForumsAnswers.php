<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "forumsAnswers".
 *
 * @property integer $id
 * @property integer $question_id
 * @property string $answer
 * @property integer $cb
 * @property string $cod
 * @property string $uod
 * @property integer $status

 */
class ForumsAnswers extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'forumsAnswers';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                    [['id', 'question_id', 'cb', 'status'], 'integer'],
                    [['question_id', 'answer', 'cb', 'cod', 'status'], 'required'],
                    [['answer'], 'string'],
                    [['cod', 'uod'], 'safe'],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'question_id' => 'Question ID',
                    'answer' => 'Answer',
                    'cb' => 'Cb',
                    'cod' => 'Cod',
                    'uod' => 'Uod',
                    'status' => 'Status',
                ];
        }

        public function getCb0() {
                return $this->hasOne(Students::className(), ['id' => 'cb']);
        }

}
