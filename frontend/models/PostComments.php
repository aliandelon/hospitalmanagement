<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "post_comments".
 *
 * @property integer $comment_id
 * @property string $comment
 * @property integer $cb
 * @property integer $status
 * @property string $cod
 * @property integer $post_id
 * @property string $field
 */
class PostComments extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'post_comments';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                    [['comment', 'cb', 'status', 'cod', 'post_id'], 'required'],
                    [['comment'], 'string'],
                    [['cb', 'status', 'post_id'], 'integer'],
                    [['cod'], 'safe'],
                    [['field'], 'string', 'max' => 45],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'comment_id' => 'Comment ID',
                    'comment' => 'Comment',
                    'cb' => 'Cb',
                    'status' => 'Status',
                    'cod' => 'Cod',
                    'post_id' => 'Post ID',
                    'field' => 'Field',
                ];
        }

        public function getCb0() {
                return $this->hasOne(Students::className(), ['id' => 'cb']);
        }

        public function getUb0() {
                return $this->hasOne(Students::className(), ['id' => 'Ub']);
        }

        public function getTopicDetails() {
                return $this->hasOne(Posts::className(), ['post_id' => 'post_id']);
        }

}
