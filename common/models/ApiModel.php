<?php

namespace common\models;

use Yii;
use common\models\PatientDetails;
use yii\db\Query;
/**
 * This is the model class for table "admin_details".
 *
 * @property int $id
 * @property int $admin_id admin_id maps with id in login table
 * @property string $name
 * @property string $email
 * @property string $phone_number
 * @property string $address
 * @property int $role_id
 * @property int $status
 * @property string profile_image
 */
class ApiModel extends \yii\db\ActiveRecord
{
    public function getUserDetails($idx, $mobile) 
    {
        $con = \Yii::$app->db;
        $response = [];
        switch ($idx) {
            case 100:
                $query = "SELECT * from patient_details where phone='$mobile' and status =1;";
                break;
            default :
                $response = ["status" => 2, "content" => ""];
                return $response;
        }
        try { 
            $result = $con->createCommand($query)->queryOne();
            $response = ["status" => 1, "content" => $result];
            $con->close();
            return $response;
        } catch (yii\db\Exception $e) {
            $response = ["status" => 0, "content" => $e];
            $con->close();
            return $response;
        }
    }
}
