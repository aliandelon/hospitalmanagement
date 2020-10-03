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
                $query = "SELECT id as UserId,first_name as firstname,last_name as lastname,email,age,CASE WHEN gender = 1 THEN 'Male' WHEN gender = 1 THEN ' Female' ELSE 'Others' END as gender,state,city,district,city,area,phone as mobileno,profile_image
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

    public function getVerifyMobile($idx, $mobile) 
    {
        $con = \Yii::$app->db;
        $response = [];
        switch ($idx) {
            case 100:
                $query = "SELECT id as UserId
                    from patient_details where phone='$mobile' and status =1;";
                break;
            default :
                $response = ["status" => 2, "content" => ""];
                return $response;
        }
        try { 
            $result = $con->createCommand($query)->queryOne();
            if($result && isset($result['UserId']))
            {
                $otpInsertion = "UPDATE patient_details SET otp = '1234' where phone='$mobile';";
                $con->createCommand($otpInsertion)->execute();
            }else{
                $result['UserId']="0";
            }
            $response = ["status" => 1, "content" => $result];
            $con->close();
            return $response;
        } catch (yii\db\Exception $e) {
            $response = ["status" => 0, "content" => $e];
            $con->close();
            return $response;
        }
    }

    public function getVerifyOtp($idx, $otp, $userId) 
    {
        $con = \Yii::$app->db;
        $response = [];
        switch ($idx) {
            case 100:
                $query = "SELECT id as UserId
                    from patient_details where otp='$otp' and id ='$userId';";
                break;
            default :
                $response = ["status" => 2, "content" => ""];
                return $response;
        }
        try { 
            $result = $con->createCommand($query)->queryOne();
            if($result && isset($result['UserId']))
            {
                if(!empty($result['UserId']))
                {
                    $content = "success";
                    $UserId = $result['UserId'];
                    $response = ["status" => 1, "content" => $content,"UserId"=>$UserId];
                }else{
                    $content = "failure";
                    $UserId = '';
                    $response = ["status" => 2, "content" => $content,"UserId"=>$UserId];
                }
            }else{
                $response = ["status" => 2, "content" => "failure","UserId"=>"$userId"];
            }
            
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

                $check = "SELECT count(id) as cnt from patient_details where id = '$datas[id]';";
                $query = "INSERT INTO patient_details(first_name,last_name,email,phone,age,gender,state,district,city,area,status,refer_id,latitude,longitude,created_on)VALUES('$datas[firstname]','$datas[lastname]','$datas[email]','$datas[mobileno]','$datas[age]','$datas[gender]','$datas[state]','$datas[district]','$datas[city]','$datas[area]',1,'$datas[refererid]','$datas[latitude]','$datas[longitude]',now())";
                $duplicateInsert = "INSERT INTO patient_details(id,first_name,last_name,email,phone,age,gender,state,district,city,area,status,refer_id,latitude,longitude,created_on)VALUES('$datas[id]','$datas[firstname]','$datas[lastname]','$datas[email]','$datas[mobileno]','$datas[age]','$datas[gender]','$datas[state]','$datas[district]','$datas[city]','$datas[area]',1,'$datas[refererid]','$datas[latitude]','$datas[longitude]',now())ON DUPLICATE KEY UPDATE id =values(id),first_name=values(first_name),last_name=values(last_name),email = values(email),phone=values(phone),age=values(age),gender=values(gender),state=values(state),district = values(district),city = values(city),area = values(area),status = values(status),refer_id=values(refer_id),latitude=values(latitude),longitude = values(longitude),created_on=values(created_on);";
                break;
            default :
                $response = ["status" => 2, "content" => ""];
                return $response;
        }
        try { 
            $checkResult = $con->createCommand($check)->queryOne();
            if($checkResult)
            {
                if($checkResult['cnt'] > 0)
                {
                    $result = $con->createCommand($duplicateInsert)->execute();
                    $id = $datas['id'];
                    $msg = "Profile Updatd";
                }else{
                    $result = $con->createCommand($query)->execute();
                    $id = $con->getLastInsertId();
                    $msg = "Profile Creted";
                }
            }else{
                    $result = $con->createCommand($query)->execute();
                    $id = $con->getLastInsertId();
                    $msg = "Profile Creted";
                }
            
            $response = ["status" => 1, "content" => $id,"msg"=>$msg];
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

    public function getHospitalLabInvestigationDetails($datas) 
    {
        $con = \Yii::$app->db;
        $response = [];
        $idx = $datas['idx'];
        switch ($idx) {
            case 100:
                $type = $datas['type'];
                $id = $datas['id'];
                if ($type == 'Hospital')
                {
                    $query = "SELECT
                                hp.name as hospitalName,
                                hp.phone_number as phone,
                                hp.city 
                            FROM
                                hospital_clinic_details hp
                            WHERE hp.status = 1 AND hp.type = 1 AND hp.user_id = '$id';";
                    $investigations = "SELECT
                                hpmapping.investigation_id as invId,
                                inv.investigation_name as invName,
                                hpmapping.amount
                            FROM
                                hospital_clinic_details hp
                            JOIN hospital_investigation_mapping hpmapping
                                ON hpmapping.hospital_clinic_id = hp.user_id
                            JOIN investigations inv ON inv.id = hpmapping.investigation_id
                            WHERE hp.status = 1 AND hp.type = 1 AND hp.user_id = '$id'";
                }else{
                    $query = "SELECT
                                hp.name as labName,
                                hp.phone_number as phone,
                                hp.city  
                            FROM
                                hospital_clinic_details hp
                            WHERE hp.status = 1 AND hp.type = 2 AND hp.user_id = '$id';";
                    $investigations = "SELECT
                                hpmapping.investigation_id as invId,
                                inv.investigation_name as invName,
                                hpmapping.amount
                            FROM
                                hospital_clinic_details hp
                            JOIN hospital_investigation_mapping hpmapping
                                ON hpmapping.hospital_clinic_id = hp.user_id
                            JOIN investigations inv ON inv.id = hpmapping.investigation_id
                            WHERE hp.status = 1 AND hp.type = 2 AND hp.user_id = '$id'";
                } 
                break;
            default :
                $response = ["status" => 2, "content" => ""];
                return $response;
        }
        try { 
            $result = $con->createCommand($query)->queryAll();
            $invResult = $con->createCommand($investigations)->queryAll();
            $response = ["status" => 1, "hospital" => $result,"investigations"=>$invResult];
            $con->close();
            return $response;
        } catch (yii\db\Exception $e) {
            $response = ["status" => 0, "content" => $e];
            $con->close();
            return $response;
        }
    }

    public function getHospitalLabInvestigationSlotdetails($datas) 
    {
        $con = \Yii::$app->db;
        $response = [];
        $idx = $datas['idx'];
        switch ($idx) {
            case 100:
                $type = $datas['type'];
                $id = $datas['id'];
                $investigations = $datas['investigations'];
                if(empty($investigations)){
                    return 'empty invstigations';
                }
                $typeVal = 1;
                if($type == 'Hospital')
                {
                    $typeVal = 1;
                }else{
                    $typeVal = 2;
                }
                $investigationsResponse = [];
                foreach ($investigations as $key => $inv) {
                    $invQuery = "SELECT DISTINCT
                                slot.id as slotId,
                                CONCAT(DATE_FORMAT(slot.from_time, '%H:%i %p'),'-',DATE_FORMAT(slot.to_time, '%H:%i %p'))as slot
                                
                            FROM slot_day_time_mapping slot
                            JOIN 
                                hospital_clinic_details hp ON hp.user_id = slot.hospital_clinic_id 
                            JOIN slot_day_mapping day ON day.hospital_clinic_id = slot.hospital_clinic_id  AND slot.investigation_id = day.investigation_id AND slot.slot_day_id = day.id
                            LEFT JOIN appointments ap ON ap.investigation_id = slot.investigation_id AND ap.hospital_clinic_id = slot.hospital_clinic_id AND slot.id = ap.slot_day_time_mapping_id
                            WHERE ap.slot_day_time_mapping_id IS NULL AND hp.status = 1 AND hp.type = '$typeVal' AND slot.hospital_clinic_id = '$id' AND slot.investigation_id = '$inv[investigation]' AND day.day ='$inv[date]' ORDER BY from_time asc;";

                    $result = $con->createCommand($invQuery)->queryAll();
                    $investigationsResponse[$inv['investigation']] = $result;
                }
                
                break;
            default :
                $response = ["status" => 2, "content" => ""];
                return $response;
        }
        try { 
            $response = ["status" => 1, "result" => $investigationsResponse];
            $con->close();
            return $response;
        } catch (yii\db\Exception $e) {
            $response = ["status" => 0, "content" => $e];
            $con->close();
            return $response;
        }
    }

    public function bookAppointments($datas) 
    {
        try { 
            $con = \Yii::$app->db;
            $response = [];
            $idx = $datas['idx'];
            switch ($idx) {
                case 100:
                    $transaction = $con->beginTransaction();
                    $type = $datas['type'];
                    $id = $datas['id'];
                    $appointments = $datas['appointments'];
                    if(empty($appointments)){
                        return 'empty appointments';
                    }
                    $typeVal = 1;
                    if($type == 'Hospital')
                    {
                        $typeVal = 1;
                    }else{
                        $typeVal = 2;
                    }
                    foreach ($appointments as $key => $appointment) {
                        //print_r($appointment);exit;
                        $appointmentQury = "INSERT INTO appointments(patient_id,doctor_id,investigation_id, slot_day_time_mapping_id,hospital_clinic_id,app_date,app_time,appointment_type)VALUES('$datas[paitientId]','$appointment[doctorId]','$appointment[invstigation]','$appointment[slotId]','$id','$appointment[date]','$appointment[time]','$appointment[appointmentType]');";
                        $result = $con->createCommand($appointmentQury)->execute();
                        if($result)
                        {
                            if($appointment['appointmentType'] == 'other')
                            {
                                if(empty($appointment['detDatas']))
                                {
                                    $transaction->rollback();
                                    return "empty other patient details";
                                }else{
                                    $det = $appointment['detDatas'];
                                    $mstId = $con->getLastInsertId();
                                    $detInsert = "INSERT INTO appoinment_det(mst_id,first_name,last_name,age,gender)VALUES('$mstId','$det[firstName]','$det[lastName]','$det[age]','$det[gender]')";
                                    $resultDet = $con->createCommand($detInsert)->execute();
                                    if($resultDet)
                                    {
                                        $transaction->commit();
                                        $return = 'success';
                                    }
                                }
                            }
                        }else{
                            $transaction->rollback();
                            $return ="Error in appointment bookings";
                        }
                    }
                    
                    break;
                default :
                    $response = ["status" => 2, "content" => ""];
                    return $response;
            }
            $response = ["status" => 1, "content" => $return];
            $con->close();
            return $response;
        } catch (yii\db\Exception $e) {
            $transaction->rollback();
            $response = ["status" => 0, "content" => $e];
            $con->close();
            return $response;
        }
    }

    public function registerUserDetails($datas) 
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
            if($result){
                $id = $con->getLastInsertId();
                $otpInsertion = "UPDATE patient_details SET otp = '1234' where id='$id';";
                    $con->createCommand($otpInsertion)->execute();
                $msg = "Profile Creted";
                $response = ["status" => 1, "content" => $id,"msg"=>$msg];
            }else{
                $response = ["status" => 0, "content" => '',"msg"=>"failure"];
            }
            $con->close();
            return $response;
        } catch (yii\db\Exception $e) {
            $response = ["status" => 0, "content" => $e];
            $con->close();
            return $response;
        }
    }

}
