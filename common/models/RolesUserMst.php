<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "roles_user_mst".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $role_id
 * @property integer $status
 */
class RolesUserMst extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'roles_user_mst';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'role_id', 'status'], 'required'],
            [['user_id', 'role_id', 'status'], 'integer'],
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
            'role_id' => 'Role ID',
            'status' => 'Status',
        ];
    }
}
