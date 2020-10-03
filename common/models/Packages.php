<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "packages".
 *
 * @property integer $id
 * @property string $package_name
 * @property string $price
 * @property string $description
 * @property string $validity
 * @property integer $sort_order
 * @property integer $status
 * @property string $created_on
 * @property string $updated_on
 */
class Packages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'packages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['package_name', 'price', 'description', 'validity', 'sort_order', 'status'], 'required'],
            [['price','discount_rate'], 'number'],
            [['description'], 'string'],
            [['validity', 'created_on', 'updated_on'], 'safe'],
            [['sort_order', 'status','validity'], 'integer'],
            [['package_name'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'package_name' => 'Package Name',
            'price' => 'Price',
            'discount_rate' =>'Discount Rate',
            'description' => 'Description',
            'validity' => 'Validity (in Days)',
            'sort_order' => 'Sort Order',
            'status' => 'Status',
            'created_on' => 'Created On',
            'updated_on' => 'Updated On',
        ];
    }
    public function viewPackages($con)
    {
         $query = "SELECT * FROM packages WHERE status='1' ORDER BY sort_order ASC LIMIT 3";
        $result = $con->createCommand($query)->queryAll();
        return $result;
    }
}
