<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property integer $post_id
 * @property integer $sub_id
 * @property integer $topic_id
 * @property string $heading
 * @property string $con_text
 * @property integer $cb
 * @property integer $ub
 * @property string $cod
 * @property string $uod
 * @property integer $status
 * @property string $serach_tags
 * @property integer $field2
 */
class Posts extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'posts';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                    [['sub_id', 'topic_id', 'heading', 'con_text'], 'required'],
                    [['sub_id', 'topic_id', 'cb', 'ub', 'status',], 'integer'],
                    [['con_text'], 'string'],
                    [['cod', 'uod'], 'safe'],
                    [['heading'], 'string', 'max' => 200],
                    [['serach_tags'], 'string', 'max' => 255],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'post_id' => 'Post ID',
                    'sub_id' => 'Sub ID',
                    'topic_id' => 'Topic ID',
                    'heading' => 'Heading',
                    'con_text' => 'Con Text',
                    'cb' => 'Cb',
                    'ub' => 'Ub',
                    'cod' => 'Cod',
                    'uod' => 'Uod',
                    'status' => 'Status',
                    'serach_tags' => 'Serach Tags',
                ];
        }

        public function getCb0() {
                return $this->hasOne(Students::className(), ['id' => 'cb']);
        }

        public function getUb0() {
                return $this->hasOne(Students::className(), ['id' => 'Ub']);
        }

        public function getTopics($params) {
                $results = [];
                if (isset($params) && $params > 0) {
                        $results = \backend\models\Topics::find()->where(['chapter_id' => $params])->all();
                }
                return $results;
        }

        public function getTests($params) {
                $results = [];
                if (isset($params) && $params > 0) {
                        $results = \backend\models\Test::find()->where(['chapter_id' => $params])->all();
                }
                return $results;
        }
        
        public function loadComments($id=0){        
        	return new \yii\data\ActiveDataProvider([
                    'query' => PostComments::find()->Where(['post_id' => $id, 'status' => 1]),
                    'pagination' => [
                        'pageSize' => 3,
                    ],
        			'sort'=> ['defaultOrder' => ['cod'=>SORT_DESC]]
                ]);
        }

}
