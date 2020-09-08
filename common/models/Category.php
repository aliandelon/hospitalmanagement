<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "category_mst".
 *
 * @property int $id
 * @property string $category_name
 * @property int $status
 * @property int $created_by
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category_mst';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_name', 'status', 'created_by'], 'required'],
            [['status', 'created_by'], 'integer'],
            [['category_name'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category_name' => Yii::t('app', 'Category Name'),
            'status' => Yii::t('app', 'Status'),
            'created_by' => Yii::t('app', 'Created By'),
        ];
    }
}
