<?php

namespace frontend\models;

use yii\data\ActiveDataProvider;
use \backend\models\Topics;

/**
 * This is the model class for table "forms".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $cb
 * @property integer $status
 * @property string $cod
 * @property integer $topic_id
 */
class Forms extends \yii\db\ActiveRecord {

        public $sub_id;

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'forms';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                    [['title', 'content', 'cb', 'status', 'cod', 'topic_id'], 'required'],
                    [['content', 'serach_tags'], 'string'],
                    [['cb', 'status', 'topic_id'], 'integer'],
                    [['cod'], 'safe'],
                    [['title'], 'string', 'max' => 255],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'title' => 'Title',
                    'content' => 'Content',
                    'cb' => 'Cb',
                    'status' => 'Status',
                    'cod' => 'Cod',
                    'topic_id' => 'Topic ID',
                    'serach_tags' => 'Search Tags'
                ];
        }

        public function loadPost($topicid = 0) {
                return new ActiveDataProvider([
                    'query' => Posts::find()->where(['status' => 0])->andWhere(['topic_id' => $topicid]),
                    'pagination' => [
                        'pageSize' => 3,
                    ],
                    'sort' => ['defaultOrder' => ['cod' => SORT_DESC]]
                ]);
        }

        public function loadAnswers($questionid = 0) {
                return new ActiveDataProvider([
                    'query' => ForumsAnswers::find()->where(['status' => 1])->andWhere(['question_id' => $questionid]),
                    'pagination' => [
                        'pageSize' => 3,
                    ],
                    'sort' => ['defaultOrder' => ['cod' => SORT_DESC]]
                ]);
        }

        public function getCb0() {
                return $this->hasOne(Students::className(), ['id' => 'cb']);
        }

        public function getUb0() {
                return $this->hasOne(Students::className(), ['id' => 'Ub']);
        }

        public function getTopicDetails() {
                return $this->hasOne(Topics::className(), ['topic_id' => 'topic_id']);
        }

}
