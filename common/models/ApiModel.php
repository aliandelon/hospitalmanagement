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
                $query = "SELECT id as UserId,first_name as firstname,last_name as lastname,email,age,CASE WHEN gender = 1 THEN 'MALE' WHEN gender = 1 THEN ' FEMALE' ELSE 'OTHERS' END as gender,state,city,district,city,area,phone as mobileno,profile_image
                    from patient_details where phone='$mobile' and status =1;";
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

    public function setUserDetails($datas) 
    {
        $con = \Yii::$app->db;
        $response = [];
        $idx = $datas['idx'];
        switch ($idx) {
            case 100:
                $query = "INSERT INTO patient_details(first_name,last_name,email,phone,age,gender,state,district,city,area,status,refer_id,latitude,longitude,created_on)VALUES('$datas[firstname]','$datas[lastname]','$datas[email]','$datas[mobileno]','$datas[age]','$datas[gender]','$datas[state]','$datas[district]','$datas[city]','$datas[area]',1,'$datas[refererid]','$datas[latitude]','$datas[longitude]',now())";
                break;
            default :
                $response = ["status" => 2, "content" => ""];
                return $response;
        }
        try { 
            $result = $con->createCommand($query)->execute();
            $id = Yii::$app->db->getLastInsertID();
            $response = ["status" => 1, "content" => $id];
            $con->close();
            return $response;
        } catch (yii\db\Exception $e) {
            $response = ["status" => 0, "content" => $e];
            $con->close();
            return $response;
        }
    }
    public function getHospitalClinicDetails($datas) 
    {
        $con = \Yii::$app->db;
        $response = [];
        $idx = $datas['idx'];
        switch ($idx) {
            case 100:
                $type = $datas['type'];
                $searchbyName = $datas['searchby_name'];
                $searchCndn = $latlonSelect = "";
                $latitude = $datas['latitude'];
                $longitude = $datas['longitude'];
                if($searchbyName != '')
                {
                    $searchCndn = "AND name like '$searchbyName' ";
                }
                
                if ($type == 'Hospital')
                {
                    if(!empty($latitude) && !empty($longitude))
                    {
                        $query = "SELECT
                                *,
                                (
                                    6371 *
                                    acos(
                                        cos( radians( '$latitude' ) ) *
                                        cos( radians(latitude) ) *
                                        cos(
                                            radians(longitude) - radians('$longitude')
                                        ) +
                                        sin(radians('$latitude')) *
                                        sin(radians(latitude))
                                    )
                                ) distance
                            FROM
                                hospital_clinic_details
                                WHERE status = 1 AND type = 1 $searchCndn 
                            HAVING
                                distance <= 25 
                            ORDER BY
                                distance
                            LIMIT
                                25 ";
                    }else {
                        $query = "SELECT * $latlonSelect FROM hospital_clinic_details WHERE status = 1 AND type = 1 $searchCndn ;";
                    }
                }else{
                    if(!empty($latitude) && !empty($longitude))
                    {
                        $query = "SELECT
                                *,
                                (
                                    6371 *
                                    acos(
                                        cos( radians( '$latitude' ) ) *
                                        cos( radians(latitude) ) *
                                        cos(
                                            radians(longitude) - radians('$longitude')
                                        ) +
                                        sin(radians('$latitude')) *
                                        sin(radians(latitude))
                                    )
                                ) distance
                            FROM
                                hospital_clinic_details
                                WHERE status = 1 AND type = 2 $searchCndn 
                            HAVING
                                distance <= 25 
                            ORDER BY
                                distance
                            LIMIT
                                25 ";
                    }else{
                        $query = "SELECT * $latlonSelect FROM hospital_clinic_details WHERE status = 1 AND type = 2 $searchCndn ;";
                    }
                } 
                break;
            default :
                $response = ["status" => 2, "content" => ""];
                return $response;
        }
        try { 
            $result = $con->createCommand($query)->queryAll();
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
