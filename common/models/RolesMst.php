<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "roles_mst".
 *
 * @property integer $id
 * @property integer $task
 * @property string $sub_task
 * @property integer $sort_order
 * @property integer $status
 */
class RolesMst extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'roles_mst';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['task', 'sub_task', 'sort_order', 'status'], 'required'],
            [['task', 'sort_order', 'status'], 'integer'],
            [['sub_task'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'task' => 'Task',
            'sub_task' => 'Sub Task',
            'sort_order' => 'Sort Order',
            'status' => 'Status',
        ];
    }
}
