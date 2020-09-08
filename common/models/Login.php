<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "login".
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $auth_key
 * @property string|null $password_reset_token
 * @property int $type 1:super admin,2:sub super admin,3:hospital admin/Diagnostic Admin
 */
class Login extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'login';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'password', 'auth_key', 'type'], 'required'],
            [['type'], 'integer'],
            [['email', 'password', 'password_reset_token'], 'string', 'max' => 250],
            [['auth_key'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'type' => Yii::t('app', 'Type'),
        ];
    }
}
