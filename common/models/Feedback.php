<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "feedback".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $user_type
 * @property string $message
 * @property integer $rating
 * @property string $submit_date
 */
class Feedback extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feedback';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'user_type', 'message', 'rating'], 'required'],
            [['user_id', 'user_type', 'rating'], 'integer'],
            [['message'], 'string'],
            [['submit_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'user_type' => 'User Type',
            'message' => 'Message',
            'rating' => 'Rating',
            'submit_date' => 'Submit Date',
        ];
    }
}
