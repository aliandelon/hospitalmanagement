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
        $images = 'http://investigohealth.com/uploads/';
        switch ($idx) {
            case 100:
                $query = "SELECT $idx as idx, id as UserId,first_name as firstname,last_name as lastname,email,age,CASE WHEN gender = 1 THEN 'Male' WHEN gender = 2 THEN ' Female' ELSE 'Others' END as gender,state,city,district,city,area,latitude,longitude,phone as mobileno,refer_id as refererid,city,area,phone as mobileno,case when profile_image <> '' then concat('$images','patientdetails/',id,'/',id,'.',profile_image) else concat('$images','patientdetails/default.png') end as profile_image
                    from patient_details where phone='$mobile' and status =1;";
                break;
            default :
                $response = ["status" => 2, "content" => ""];
                return $response;
        }
        try { 
            $result = $con->createCommand($query)->queryOne();
            $response = ["status" => 1, "userData" => $result];
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
                $insert = "INSERT INTO patient_details(phone,status,otp)values('$mobile','1','1234');";
                $result1 = $con->createCommand($insert)->execute();
                $userId = $con->getLastInsertId();
                $result['UserId']=$userId;
            }
            $response = ["status" => 1, "content" => $result];
            return $response;
            $con->close();
        } catch (yii\db\Exception $e) {
            $response = ["status" => 0, "content" => $e];
            $con->close();
            return $response;
        }
    }

    public function getVerifyOtp($idx, $otp, $userId, $mobile, $firebaseToken) 
    {
        $con = \Yii::$app->db;
        $response = [];
        switch ($idx) {
            case 100:
                $query = "SELECT id as UserId,first_name,last_name
                    from patient_details where otp='$otp' and phone ='$mobile';";
                $insert="UPDATE patient_details SET firebase_token = '$firebaseToken' WHERE phone ='$mobile' AND id='$userId';";
                break;
            default :
                $response = ["status" => 2, "content" => ""];
                return $response;
        }
        try { 
            $profileComplete = false;
            $result = $con->createCommand($query)->queryOne();
            if($result && isset($result['UserId']))
            {
                $result2 = $con->createCommand($insert)->execute();
                if(!empty($result['UserId']))
                {

                    if(!empty($result['first_name']))
                    {
                        $profileComplete = true;
                    }
                    $content = "success";
                    $UserId = $result['UserId'];
                    $response = ["status" => 1, "content" => $content,"UserId"=>$UserId,"profileComplete"=>$profileComplete];
                }else{
                    $content = "failure";
                    $UserId = '';
                    $response = ["status" => 2, "content" => $content,"UserId"=>$UserId,"profileComplete"=>$profileComplete];
                }
            }else{
                $response = ["status" => 2, "content" => "failure","UserId"=>"$userId","profileComplete"=>$profileComplete];
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
        
        $images = 'http://investigohealth.com/uploads/';
       
        switch ($idx) {
            case 100:
                if($datas['gender']=='Male'){$gender=1;}else if($datas['gender']=='Female'){$gender=2;}else{$gender='';}
                $check = "SELECT count(id) as cnt from patient_details where id = '$datas[userId]'";
                //   $duplicateInsert = "INSERT INTO patient_details(id,first_name,last_name,email,phone,age,gender,state,district,city,area,status,refer_id,latitude,longitude,created_on,profile_image)VALUES('$datas[userId]','$datas[firstname]','$datas[lastname]','$datas[email]','$datas[mobileno]','$datas[age]','$datas[gender]','$datas[state]','$datas[district]','$datas[city],'$datas[area]',1,'$datas[refererid]','$datas[latitude]','$datas[longitude]',now(),'')ON DUPLICATE KEY UPDATE id =values(id),first_name=values(first_name),last_name=values(last_name),email = values(email),phone=values(phone),age=values(age),gender=values(gender),state=values(state),district = values(district),city = values(city),area = values(area),status = values(status),refer_id=values(refer_id),latitude=values(latitude),longitude = values(longitude),created_on=values(created_on),profile_image=values(profile_image);";
                $duplicateInsert = "INSERT INTO patient_details(id,first_name,last_name,email,phone,age,gender,state,district,city,area,status,refer_id,latitude,longitude,created_on)VALUES('$datas[userId]','$datas[firstname]','$datas[lastname]','$datas[email]','$datas[mobileno]','$datas[age]','$gender','$datas[state]','$datas[district]','$datas[city]','$datas[area]',1,'$datas[refererid]','$datas[latitude]','$datas[longitude]',now())ON DUPLICATE KEY UPDATE id =values(id),first_name=values(first_name),last_name=values(last_name),email = values(email),phone=values(phone),age=values(age),gender=values(gender),state=values(state),district = values(district),city = values(city),area = values(area),status = values(status),refer_id=values(refer_id),latitude=values(latitude),longitude = values(longitude),created_on=values(created_on);";
               
                break;
            default :
                $response = ["status" => 2, "content" => ""];
                return $response;
        }
        //try { 
            $checkResult = $con->createCommand($check)->queryOne();
            if($checkResult)
            {
                if($checkResult['cnt'] > 0)
                {
                    $result = $con->createCommand($duplicateInsert)->execute();
                    if($result)
                    {
                        $id = $datas['userId'];
                        $image = $datas['profile_image'];
                        if($image != '')
                        {
                            list($type, $image) = explode(';', $image);
                            list(, $image)      = explode(',', $image);
                            $image = base64_decode($image);
                            $extensions = explode('/', $type);
                            $extension = $extensions[1];
                            $targetFolder = \yii::$app->basePath . '/../uploads/patientdetails/' . $id ;
                            $files = glob($targetFolder . '/*');
                            //Loop through the file list.
                            foreach($files as $file){
                                //Make sure that this is a file and not a directory.
                                if(is_file($file)){
                                    //Use the unlink function to delete the file.
                                    unlink($file);
                                }
                            }
                            if (!file_exists($targetFolder. '/')) {
                                mkdir($targetFolder. '/', 0777, true);
                                chmod($targetFolder. '/',0777);
                            }
                            file_put_contents($targetFolder. '/' . $id . '.' . $extension, $image);
                            $imageInsertion = "UPDATE patient_details set profile_image = '$extension' where id='$id';";
                            $con->createCommand($imageInsertion)->execute();
                        }
                    }
                    $userQuery = "SELECT $idx as idx, id as userId,first_name as firstname,last_name as lastname,email,age,CASE WHEN gender = 1 THEN 'Male' WHEN gender = 2 THEN 'Female' ELSE 'Other' END as gender,state,city,district,city,area,latitude,longitude,phone as mobileno,refer_id as refererid,case when profile_image <> '' then concat('$images','patientdetails/',id,'/',id,'.',profile_image) else concat('$images','patientdetails/default.png') end as profile_image
                    from patient_details where id = '$datas[userId]' AND phone='$datas[mobileno]' and status =1;";
                    $userResult = $con->createCommand($userQuery)->queryOne();
                    $msg = "Profile Updated";
                    $status = 1;
                }else{
                    $userResult = [];
                    $msg = "Profile Not Found";
                    $status = 2;
                    $response = ["status" => $status, "content" => $userResult,"msg"=>$msg];
                    return $response;
                }
            }else{ 
                    $userResult = [];
                    $msg = "Profile Not Found";
                    $status = 2;
                }
            
            $response = ["status" => $status, "content" => $userResult,"msg"=>$msg];
            $con->close();
            return $response;
        // } catch (yii\db\Exception $e) {
        //     $response = ["status" => 0, "content" => $e];
        //     $con->close();
        //     return $response;
        // }
    }
    public function getHospitalLabsDetails($datas) 
    {
       
        $con = \Yii::$app->db;
        $response = [];
        $idx = $datas['idx'];
        $curDate = date('Y-m-d');
        $images = 'http://investigohealth.com/uploads/';
        
        switch ($idx) {
            case 100:
                $type = $datas['type'];
                $searchbyName = $datas['searchby_name'];
                $searchCndn = $latlonSelect = $limitOffset = "";
                $latitude = $datas['latitude'];
                $longitude = $datas['longitude'];
                $pageLength = $datas['page_length'];
                $userId     = isset($datas['userId'])?$datas['userId']:'';
                $curPage = isset($datas['current_page'])?$datas['current_page']:0;
                $city = $datas['city'];
                if($curPage == 0)
                {
                    $start = 0;
                }else{
                    $start = $curPage*$pageLength;
                }
                if(!empty($pageLength) && isset($curPage))
                {
                    $limitOffset = " LIMIT $pageLength OFFSET $start ";
                }
                if($searchbyName != '')
                {
                    $searchCndn = "AND name like '%$searchbyName%' ";
                }
                $bannerQuery = "SELECT concat('$images','banners/',id,'/',id,'.',image) as image from banners where expiry_date > '$curDate' and status = 1; ";
                
                if ($type == 'Hospital')
                {   
                    if($city == '' && empty($latitude) && empty($longitude))
                    {
                        if(!empty($userId))
                        { 
                            $userCity = "SELECT city from patient_details where id = '$userId';";
                            $result = $con->createCommand($userCity)->queryOne();
                            if($result)
                            {
                                $cityVal = $result['city'];
                                $searchCndn.= "AND city like '%$cityVal%' ";
                                $query = "SELECT user_id as id,name,type,phone_number,email,address,pincode,street1,street2,city,area,case when hospital_clinic_image <> '' then concat('$images','hospitalClinicImage/',id,'/',id,'.',hospital_clinic_image) else '' end as image FROM hospital_clinic_details WHERE status = 1 AND type = 1 $searchCndn $limitOffset;";
                                $countQuery = "SELECT count(user_id) as cnt FROM hospital_clinic_details WHERE status = 1 AND type = 1 $searchCndn;";
                            }else{
                                $response = ["status" => 2, "content" => "user city is empty"];
                                return $response;
                            }
                        }else{ 
                            $response = ["status" => 2, "content" => "please pass user id"];
                            return $response;
                        }
                    }
                    else if($city != '')
                    {
                        $searchCndn.= "AND city like '%$city%' ";
                        $query = "SELECT user_id as id,name,type,phone_number,email,address,pincode,street1,street2,city,area,case when hospital_clinic_image <> '' then concat('$images','hospitalClinicImage/',id,'/',id,'.',hospital_clinic_image) else '' end as image FROM hospital_clinic_details WHERE status = 1 AND type = 1 $searchCndn $limitOffset;";
                        $countQuery = "SELECT count(user_id) as cnt FROM hospital_clinic_details WHERE status = 1 AND type = 1 $searchCndn;";
                    }else if(!empty($latitude) && !empty($longitude))
                    {
                        $query = "SELECT
                                user_id as id,name,type,phone_number,email,address,pincode,street1,street2,city,area,
                                case when hospital_clinic_image <> '' then concat('$images','hospitalClinicImage/',id,'/',id,'.',hospital_clinic_image) else '' end as image,
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
                            $limitOffset";
                        $countQuery = "SELECT
                                count(user_id) as cnt,
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
                                distance";
                    }
                }else{
                    
                    if($city == '' && empty($latitude) && empty($longitude))
                    {
                        if(!empty($userId))
                        { 
                            $userCity = "SELECT city from patient_details where id = '$userId';";
                            $result = $con->createCommand($userCity)->queryOne();
                            if($result)
                            {
                                $cityVal = $result['city'];
                                $searchCndn.= "AND city like '%$cityVal%' ";
                                $query = "SELECT user_id as id,name,type,phone_number,email,address,pincode,street1,street2,city,area,case when hospital_clinic_image <> '' then concat('$images','hospitalClinicImage/',id,'/',id,'.',hospital_clinic_image) else '' end as image FROM hospital_clinic_details WHERE status = 1 AND type = 2 $searchCndn $limitOffset;";
                                $countQuery = "SELECT count(user_id) as cnt FROM hospital_clinic_details WHERE status = 1 AND type = 2 $searchCndn;";
                            }else{
                                $response = ["status" => 2, "content" => "user city is empty"];
                                return $response;
                            }
                        }else{ 
                            $response = ["status" => 2, "content" => "please pass user id"];
                            return $response;
                        }
                    }
                    else if($city != '')
                    {
                        $searchCndn.= "AND city like '%$city%' ";
                        $query = "SELECT user_id as id,name,type,phone_number,email,address,pincode,street1,street2,city,area,case when hospital_clinic_image <> '' then concat('$images','hospitalClinicImage/',id,'/',id,'.',hospital_clinic_image) else '' end as image FROM hospital_clinic_details WHERE status = 1 AND type = 2 $searchCndn $limitOffset;";
                        $countQuery = "SELECT count(user_id) as cnt FROM hospital_clinic_details WHERE status = 1 AND type = 2 $searchCndn $limitOffset;";
                    }else if(!empty($latitude) && !empty($longitude))
                    {
                        $query = "SELECT
                                user_id as id,name,type,phone_number,email,address,pincode,street1,street2,city,area,
                                case when hospital_clinic_image <> '' then concat('$images','hospitalClinicImage/',id,'/',id,'.',hospital_clinic_image) else '' end as image,
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
                            $limitOffset";
                        $countQuery = "SELECT
                                count(user_id) as cnt,
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
                                distance;";
                    }
                } 
                break;
            default :
                $response = ["status" => 2, "content" => ""];
                return $response;
        }
        try { //print($query);exit;
            $result = $con->createCommand($query)->queryAll();
            $totalRecords = $con->createCommand($countQuery)->queryOne();
            if($totalRecords)
            {
                $total = $totalRecords['cnt'];
            }else{
                $total = '';
            }
            $banner = $con->createCommand($bannerQuery)->queryAll();
            $response = ["status" => 1, "data" => $result,"current_page"=>$curPage,"total_rcords"=>$total,"banner_images"=>$banner];
            $con->close();
            return $response;
        } catch (yii\db\Exception $e) {
            $response = ["status" => 0, "content" => $e];
            $con->close();
            return $response;
        }
    }

    public function getHospitalDetails($datas) 
    {
        $con = \Yii::$app->db;
        $response = [];
        $idx = $datas['idx'];
        $curDate = date('Y-m-d');
        $images = 'http://investigohealth.com/uploads/';
        switch ($idx) {
            case 100:
                $type = $datas['type'];
                $id = $datas['id'];
                $query = "SELECT user_id as id,name,type,phone_number,email,address,pincode,street1,street2,city,area,case when hospital_clinic_image <> '' then concat('$images','hospitalClinicImage/',id,'/',id,'.',hospital_clinic_image) else '' end
                 as image
                            FROM
                                hospital_clinic_details 
                            WHERE status = 1 AND type = 1 AND user_id = '$id';";
                $doctorsQuery = "SELECT doc.id,doc.name,doc.experience as experiance,CASE when profile_image <> '' then 
                concat('$images','doctors/',doc.id,'/',doc.id,'.',doc.profile_image) else concat('$images','doctors/default.png') end as doctor_image
                ,sep.name as speciality,coalesce(fee_charges,0.00) as fees_charges
                        FROM doctors_details doc
                        JOIN doctor_specialty_mst sep ON sep.id = doc.specialty_id WHERE doc.hospital_clinic_id = '$id';";
               
                break;
            default :
                $response = ["status" => 2, "content" => ""];
                return $response;
        }
        try { 
            $result = $con->createCommand($query)->queryOne();
            $docResult = $con->createCommand($doctorsQuery)->queryAll();
            $result['doctor_list'] = $docResult;
            $response = ["status" => 1, "hospital" => $result];
            $con->close();
            return $response;
        } catch (yii\db\Exception $e) {
            $response = ["status" => 0, "content" => $e];
            $con->close();
            return $response;
        }
    }

    public function getLabDetails($datas) 
    {
        $con = \Yii::$app->db;
        $response = [];
        $idx = $datas['idx'];
        $images = 'http://investigohealth.com/../uploads/';
        switch ($idx) {
            case 100:
                $type = $datas['type'];
                $id = $datas['id'];
                $query = "SELECT user_id as id,name,type,phone_number,email,address,pincode,street1,street2,city,area,case when hospital_clinic_image <> '' then concat('$images','hospitalClinicImage/',id,'/',id,'.',hospital_clinic_image) else '' end
                 as image
                            FROM
                                hospital_clinic_details 
                            WHERE status = 1 AND type = 2 AND user_id = '$id';";
                $labCategory = "SELECT DISTINCT cat.id as category_id,cat.category_name as category FROM hospital_investigation_mapping hp JOIN investigations inv ON inv.id = hp.investigation_id 
                    JOIN category_mst cat ON cat.id = inv.mst_id
                    WHERE hp.hospital_clinic_id = '$id' AND inv.status = 1;";
                
                break;
            default :
                $response = ["status" => 2, "content" => ""];
                return $response;
        }
        //try { 
            $result = $con->createCommand($query)->queryAll();
            $catResult = $con->createCommand($labCategory)->queryAll();
            $invResponse = [];
            if($catResult)
            {
                foreach ($catResult as $key => $cat) {
                    $investigations = "SELECT
                                hpmapping.investigation_id as sub_category_id,
                                inv.investigation_name as name,
                                hpmapping.amount as price,CASE hpmapping.isHomeCollection WHEN 1 THEN 'true' ELSE 'false'  END as isHomeCollection ,COALESCE(hpmapping.details,'') as package_details 
                            FROM
                                hospital_clinic_details hp
                            JOIN hospital_investigation_mapping hpmapping
                                ON hpmapping.hospital_clinic_id = hp.user_id
                            JOIN investigations inv ON inv.id = hpmapping.investigation_id
                            WHERE hp.status = 1 AND hp.type = 2 AND hp.user_id = '$id' AND inv.mst_id = 
                            '$cat[category_id]';";
                    $invResult = $con->createCommand($investigations)->queryAll();
                    if($invResult){
                        $invResponse[] = [
                            'category_id'=>$cat['category_id'],
                            'category'   =>$cat['category'],
                            'data'=>$invResult
                        ];
                    }
                }
            }
            $response = ["status" => 1, "laboratory" => $result,"service"=>$invResponse];
            $con->close();
            return $response;
        // } catch (yii\db\Exception $e) {
        //     $response = ["status" => 0, "content" => $e];
        //     $con->close();
        //     return $response;
        // }
    }

    public function getLaboratorySlotdetails($datas) 
    {   
        date_default_timezone_set("Asia/Kolkata");
        $con = \Yii::$app->db;
        $response = [];
        $idx = $datas['idx'];
        switch ($idx) {
            case 100:
                $type = $datas['type'];
                $id = $datas['id'];
                if(empty($datas['sub_category_id']) && $datas['sub_category_id'] != ''){
                    return 'empty invstigations';
                }
                $investigation = $datas['sub_category_id'];
                $date = $datas['date'];
                $day =date("l",strtotime($date));
                if($day == "Monday"){
                    $dateDay = 0;
                }elseif($day == "Tuesday")
                {
                    $dateDay = 1;
                }elseif($day == "Wednesday")
                {
                    $dateDay = 2;
                }elseif($day == "Thursday")
                {
                    $dateDay = 3;
                }elseif($day == "Friday")
                {
                    $dateDay = 4;
                }elseif($day == "Saturday")
                {
                    $dateDay = 5;
                }else{
                    $dateDay = 6;
                }

                $today = date('Y-m-d');
                $typeVal = 1;
                if($type == 'Hospital')
                {
                    $typeVal = 1;
                }else{
                    $typeVal = 2;
                }
                $investigationsResponse = [];
                /*$invQuery = "SELECT DISTINCT
                            slot.id as slotId,
                            CONCAT(DATE_FORMAT(slot.from_time, '%H:%i %p'),'-',DATE_FORMAT(slot.to_time, '%H:%i %p'))as time
                        FROM slot_day_time_mapping slot
                        JOIN 
                            hospital_clinic_details hp ON hp.user_id = slot.hospital_clinic_id 
                        JOIN slot_day_mapping day ON day.hospital_clinic_id = slot.hospital_clinic_id  AND slot.investigation_id = day.investigation_id AND slot.slot_day_id = day.id
                        LEFT JOIN appointments ap ON ap.investigation_id = slot.investigation_id AND ap.hospital_clinic_id = slot.hospital_clinic_id AND slot.id = ap.slot_day_time_mapping_id
                        LEFT JOIN holiday_list holy ON 
                    -- holy.investigation_id = slot.investigation_id AND 
                    holy.hospital_id = slot.hospital_clinic_id AND holy.holiday_date = '$date'
                        LEFT JOIN holiday_list holy1 ON 
                    holy1.investigation_id = slot.investigation_id AND 
                    holy1.hospital_id = slot.hospital_clinic_id AND holy1.holiday_date = '$date'
                        WHERE ap.slot_day_time_mapping_id IS NULL AND 
                            holy.id IS NULL AND holy1.id IS NULL AND hp.status = 1 AND hp.type = '$typeVal' AND slot.hospital_clinic_id = '$id' AND slot.investigation_id = '$investigation' AND day.day ='$date' AND day.day>='$today' AND (slot.from_time > DATE_FORMAT(NOW(), '%Y-%m-%d %T') AND slot.to_time > DATE_FORMAT(NOW(), '%Y-%m-%d %T')) ORDER BY from_time asc;";*/
                $invQuery = "SELECT DISTINCT
                        slot.id AS slotId,slot.slot_time AS time
                        /*REPLACE(REPLACE(slot.slot_time, 'am', 'AM'),'pm','PM') AS time*/
                    FROM
                        sloat_time_mapping slot
                    JOIN hospital_investigation_day_mapping invday ON invday.id = slot. investigation_mapping_id
                    JOIN hospital_clinic_details hp ON
                        hp.user_id = invday.hospital_id
                    LEFT JOIN appointments ap ON
                        -- ap.investigation_id = invday.id AND ap.hospital_clinic_id = invday.hospital_id
                    ap.investigation_id = invday.investigation_id AND ap.hospital_clinic_id = invday.hospital_id AND ap.app_date =  '$date'  AND slot.id  = ap.slot_day_time_mapping_id
                    LEFT JOIN holiday_list holy ON
                        holy.hospital_id = invday.hospital_id  AND holy.holiday_date = '$date'
                    LEFT JOIN holiday_list holy1 ON
                        holy1.investigation_id = invday.investigation_id AND holy1.hospital_id = invday.hospital_id AND holy1.holiday_date = '$date'
                    WHERE
                        ap.slot_day_time_mapping_id IS NULL AND holy.id IS NULL AND holy1.id IS NULL AND hp.status = 1 AND hp.type = '$typeVal' AND invday.hospital_id  = '$id' AND invday.investigation_id = '$investigation'
                        AND invday.day_id = '$dateDay' 
                      /*AND  SUBSTRING_INDEX
                      (slot.slot_time, '-', '1')  
                      > DATE_FORMAT(NOW(), '%r')*/
                        ORDER BY
                            slot.id ASC;";
                    $result = $con->createCommand($invQuery)->queryAll();
                break;
            default :
                $response = ["status" => 2, "content" => ""];
                return $response;
        }
        try { 
            $response = ["status" => 1, "time_slot" => $result];
            $con->close();
            return $response;
        } catch (yii\db\Exception $e) {
            $response = ["status" => 0, "content" => $e];
            $con->close();
            return $response;
        }
    }

    public function getDoctorSlotdetails($datas) 
    {
        date_default_timezone_set("Asia/Kolkata");
        $con = \Yii::$app->db;
        $response = [];
        $idx = $datas['idx'];
        switch ($idx) {
            case 100:
                $type = $datas['type'];
                $id = $datas['id'];
                $doctorId = $datas['doctorId'];
                $date = $datas['date'];
                $today = date('Y-m-d');
                $typeVal = 1;
                if($type == 'Hospital')
                {
                    $typeVal = 1;
                }else{
                    $typeVal = 2;
                }
                $day =date("l",strtotime($date));
                if($day == "Monday"){
                    $dateDay = 0;
                }elseif($day == "Tuesday")
                {
                    $dateDay = 1;
                }elseif($day == "Wednesday")
                {
                    $dateDay = 2;
                }elseif($day == "Thursday")
                {
                    $dateDay = 3;
                }elseif($day == "Friday")
                {
                    $dateDay = 4;
                }elseif($day == "Saturday")
                {
                    $dateDay = 5;
                }else{
                    $dateDay = 6;
                }
                // $docQuery = "SELECT DISTINCT
                //             slot.id as slotId,
                //             CONCAT(DATE_FORMAT(slot.from_time, '%H:%i %p'),'-',DATE_FORMAT(slot.to_time, '%H:%i %p'))as time
                //         FROM slot_day_time_mapping slot
                //         JOIN 
                //             hospital_clinic_details hp ON hp.user_id = slot.hospital_clinic_id 
                //         JOIN slot_day_mapping day ON day.hospital_clinic_id = slot.hospital_clinic_id  AND slot.doctor_id = day.doctor_id AND slot.slot_day_id = day.id
                //         LEFT JOIN appointments ap ON ap.doctor_id = slot.doctor_id AND ap.hospital_clinic_id = slot.hospital_clinic_id AND slot.id = ap.slot_day_time_mapping_id
                //         LEFT JOIN holiday_list holy ON 
                //         -- holy.doctor_id = slot.doctor_id AND 
                //         holy.hospital_id = slot.hospital_clinic_id AND holy.holiday_date = '$date'
                //         LEFT JOIN holiday_list holy1 ON 
                //          holy1.doctor_id = slot.doctor_id AND 
                //         holy1.hospital_id = slot.hospital_clinic_id AND holy1.holiday_date = '$date'
                //         WHERE ap.slot_day_time_mapping_id IS NULL AND 
                //             holy.id IS NULL AND holy1.id IS NULL AND hp.status = 1 AND hp.type = '$typeVal' AND slot.hospital_clinic_id = '$id' AND slot.doctor_id = '$doctorId' AND day.day ='$date' AND day.day>='$today' AND (slot.from_time > DATE_FORMAT(NOW(), '%Y-%m-%d %T') AND slot.to_time > DATE_FORMAT(NOW(), '%Y-%m-%d %T'))  ORDER BY from_time asc;";
            $docQuery = "SELECT DISTINCT
                        slot.id AS slotId,slot.slot_time AS time
                        /*REPLACE(REPLACE(slot.slot_time, 'am', 'AM'),'pm','PM') AS time*/

                    FROM
                        doctor_slot_time_mapping slot
                    JOIN doctor_hospital_day_mapping invday ON invday.id = slot.day_mapping_id
                    JOIN hospital_clinic_details hp ON
                        hp.user_id = invday.hospital_id
                    LEFT JOIN appointments ap ON
                        ap.doctor_id = invday.doctor_id AND ap.hospital_clinic_id = invday.hospital_id AND ap.app_date =  '$date' AND slot.id  = ap.slot_day_time_mapping_id 
                    LEFT JOIN holiday_list holy ON
                        holy.hospital_id = invday.hospital_id  AND holy.holiday_date = '$date'
                    LEFT JOIN holiday_list holy1 ON
                        holy1.doctor_id = invday.doctor_id AND holy1.hospital_id = invday.hospital_id AND holy1.holiday_date = '$date'
                    WHERE
                        ap.slot_day_time_mapping_id IS NULL AND holy.id IS NULL AND holy1.id IS NULL AND hp.status = 1 AND hp.type = '$typeVal' AND invday.hospital_id  = '$id' AND invday.doctor_id = '$doctorId'
                        AND invday.day_id = '$dateDay' 
                      /*AND  SUBSTRING_INDEX
                      (slot.slot_time, '-', '1')  
                      > DATE_FORMAT(NOW(), '%r')*/
                        ORDER BY
                            slot.id ASC;";
                    $result = $con->createCommand($docQuery)->queryAll();
                break;
            default :
                $response = ["status" => 2, "content" => ""];
                return $response;
        }
        try { 
            $response = ["status" => 1, "time_slot" => $result];
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
                    $investigations = $datas['investigations'];
                    if(empty($investigations)){
                        return 'empty investigations';
                    }
                    $typeVal = 1;
                    if($type == 'Hospital')
                    {
                        $typeVal = 1;
                    }else{
                        $typeVal = 2;
                    }
                    $appointmentType = $datas['appointmentType'];
                    if($appointmentType == 'other')
                    {
                        $appointmentTypeVal = 1; 
                    }else{
                        $appointmentTypeVal = 0;
                    }
                    $totalPrice = $adminTotal =  0;
                    $status = $superAdminActntId = $superAdminActntName = $labAcntId = $labAcntName = "";
                    $resultVal = 1;
                    $bookedDuplicateArray = [];
                    $bookedArray = [];
                    $superAdminCommision = "SELECT razorpay_id AS super_admin_account_id,razorpay_name AS super_admin_account_name FROM admin_details WHERE role_id = '10';";
                    $commisionDetails = "SELECT commision_type, commision, razorpay_id AS lab_hospital_account_id,razorpay_name AS lab_hospital_account_name FROM hospital_clinic_details WHERE user_id='$id'; ";
                    $superAdminCommisionResult = $con->createCommand($superAdminCommision)->queryOne();
                    $commisionDetailsResult = $con->createCommand($commisionDetails)->queryOne();
                    if($superAdminCommisionResult)
                    {
                        $superAdminActntId = $superAdminCommisionResult['super_admin_account_id'];
                        $superAdminActntName = $superAdminCommisionResult['super_admin_account_name'];
                        if($commisionDetailsResult)
                        {
                            $labAcntName = $commisionDetailsResult['lab_hospital_account_name'];
                            $labAcntId = $commisionDetailsResult['lab_hospital_account_id'];
                            $commisionType = $commisionDetailsResult['commision_type'];
                            $commision = $commisionDetailsResult['commision'];
                        }else{
                            $commisionType = '';
                            $commision = '';
                        }
                    }
                    $bookId = "SELECT coalesce(MAX(booking_id),0) as bookId from appointments;";
                    $bookingResult = $result = $con->createCommand($bookId)->queryOne();
                    if($bookingResult){
                        $bookId = $bookingResult['bookId'] + 1;
                    }else{
                        $bookId = 1;
                    }
                    foreach ($investigations as $key => $appointment) {
                        $checkSql = "SELECT  count(patient_id) cnt from appointments where doctor_id = '$appointment[doctorId]' AND investigation_id = '$appointment[investigation_id]' AND slot_day_time_mapping_id ='$appointment[slotId]' AND  hospital_clinic_id = '$id' AND app_date = '$appointment[date]';";
                        $count = $result = $con->createCommand($checkSql)->queryOne();
                        if($count && $count['cnt'] > 0)
                        {
                            $status = 2 ;
                            $resultVal = 2;
                            $bookedDuplicateArray[] = $appointment;
                            $transaction->commit();
                            $response = ["status" => $status, "alradyBookedAppoinments" => $bookedDuplicateArray,"booking_status"=>"failure","total_amount_to_pay"=>$totalPrice];
                            return $response;
                        }
                        $totalPrice = $totalPrice + $appointment['price'];
                        if($commisionType == 1){
                            $adminTotal = $adminTotal + $commision;
                        }else{
                            $perCentage = ($commision * $appointment['price']) /100;
                            $adminTotal = $adminTotal + $perCentage;
                        }
                        $appointmentQuery = "INSERT INTO appointments(  booking_id,patient_id,doctor_id,investigation_id, slot_day_time_mapping_id,hospital_clinic_id,app_date,app_time,appointment_type,isHomeCollection,price)VALUES('$bookId','$datas[paitientId]','$appointment[doctorId]','$appointment[investigation_id]','$appointment[slotId]','$id','$appointment[date]','$appointment[time]','$appointmentTypeVal','$appointment[isHomeCollection]','$appointment[price]');";
                        $result = $con->createCommand($appointmentQuery)->execute();
                        if($result)
                        {   $bookingId =$con->getLastInsertId();
                            if($appointmentType == 'other')
                            { 
                                if(empty($datas['detDatas']))
                                {
                                    // $transaction->rollback();
                                    // return "empty other patient details";
                                    $status = 3 ;
                                    $resultVal = 3;
                                    $msg = "empty other patient details";
                                    break;
                                }else{
                                    $det = $datas['detDatas'];
                                    $detInsert = "INSERT INTO appoinment_det(mst_id,first_name,last_name,age,gender)VALUES('$bookingId','$det[firstName]','$det[lastName]','$det[age]','$det[gender]')";
                                    $resultDet = $con->createCommand($detInsert)->execute();
                                    if($resultDet)
                                    {
                                        //$transaction->commit();
                                        $resultVal = 1;
                                        $status = 1;
                                        $bookedArray[] = $bookingId;
                                        // $response = ["status" => 1, "bookingId" => $bookingId,"booking_status"=>"pending","total_amount_to_pay"=>$totalPrice];
                                    }
                                }
                            }else{
                               //$transaction->commit(); 
                                $resultVal = 1;
                                $status = 1;
                                $bookedArray[] = $bookingId;
                            }
                            // $response = ["status" => 1, "bookingId" => $bookingId,"booking_status"=>"pending","total_amount_to_pay"=>$totalPrice];
                        }else{
                            // $transaction->rollback();
                            // return "Error in appointment bookings";
                            $resultVal = 4;
                            $status = 4;
                        }
                    }
                    if($resultVal == 1){
                        $transaction->commit();
                        $response = ["status" => 1, "bookingId" => $bookId,"booking_status"=>"pending","total_amount_to_pay"=>$totalPrice,"super_admin_account_id"=>$superAdminActntId,"super_admin_account_name"=>$superAdminActntName,"super_admin_commison_amount"=>$adminTotal,"lab_hospital_account_id"=>$labAcntId,"lab_hospital_account_name"=>$labAcntName,"lab_hospital_commison_amount"=>($totalPrice - $adminTotal)];
                    }else{
                        if($resultVal == 3)
                        {
                            $msg = "empty other patient details";
                        }elseif($resultVal == 4)
                        {
                            $msg ="Error in appointment bookings";
                        }
                        $transaction->rollback();
                        $response = ["status" => 1,"message"=>$msg];
                    }
                    break;
                default :
                    return $response;
            }
            return $response;
            $con->close();
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
        $images ='http://investigohealth.com/../uploads/';
        switch ($idx) {
            case 100:
            $image = $datas['profile_image'];
            
            if($datas['mobileno'] == '' || empty($datas['mobileno']))
            {
                $response = ["status" => 0, "content" => '',"msg"=>"failure, empty mobile no"];
                return $response;
            }
            if(strlen($datas['mobileno']) > 10 || strlen($datas['mobileno']) < 10)
            { 
                $response = ["status" => 0, "content" => '',"msg"=>"failure, invalid mobile no"];
                return $response;
            }
            $checkMobile = "SELECT id from patient_details where phone = '$datas[mobileno]';";
            $checkResult = $con->createCommand($checkMobile)->queryOne();
            if($checkResult)
            {
                if($checkResult['id']){
                    $id = $checkResult['id'];
                }else{
                    $response = ["status" => 0, "content" => '',"msg"=>"failure"];
                    return $response;
                }
            }else{
                $response = ["status" => 0, "content" => '',"msg"=>"failure"];
                return $response;
            }
            if($datas['gender']=='Male'){$gender=1;}else if($datas['gender']=='Female'){$gender=2;}else{$gender='';}
            $query = "UPDATE patient_details SET first_name = '$datas[firstname]',last_name = '$datas[lastname]',email ='$datas[email]',age='$datas[age]',gender='$gender',state='$datas[state]',district = '$datas[district]',city='$datas[city]',area='$datas[area]',refer_id='$datas[refererid]',latitude = '$datas[latitude]',longitude = '$datas[longitude]' WHERE id = '$id' AND phone = '$datas[mobileno]';";
                break;
            default :
                $response = ["status" => 2, "content" => ""];
                return $response;
        }
        try { 
            
            $result = $con->createCommand($query)->execute();
            if($result){
                if($image != '' || trim($image != ''))
                { 
                    list($type, $image) = explode(';', $image);
                    list(, $image)      = explode(',', $image);
                    $image = base64_decode($image);
                    $extensions = explode('/', $type);
                    $extension = $extensions[1];
                    $targetFolder = \yii::$app->basePath . '/../uploads/patientdetails/' . $id . '/';
                    if (!file_exists($targetFolder)) {
                        mkdir($targetFolder, 0777, true);
                        chmod($targetFolder,0777);
                    }
                    file_put_contents($targetFolder . $id . '.' . $extension, $image);
                }else{

                    $extension = '';
                }
                
            }
                $userQuery = "SELECT $idx as idx, id as userId,first_name as firstname,last_name as lastname,email,age,CASE WHEN gender = 1 THEN 'Male' WHEN gender = 2 THEN ' Female' ELSE 'Others' END as gender,state,city,district,city,area,latitude,longitude,phone as mobileno,refer_id as refererid,case when profile_image <> '' then concat('$images','patientdetails/',id,'/',id,'.',profile_image) else concat('$images','patientdetails/default.png') end as profile_image
                    from patient_details where id = '$id' AND phone='$datas[mobileno]' and status =1;";
                $userResult = $con->createCommand($userQuery)->queryOne();
                $response = ["status" => 1, "content" => $userResult];
            
            $con->close();
            return $response;
        } catch (yii\db\Exception $e) {
            $response = ["status" => 0, "content" => $e];
            $con->close();
            return $response;
        }
    }

    public function setFeedBack($data) 
    {
        $con = \Yii::$app->db;
        $response = [];
        $idx = $data['idx'];
        switch ($idx) {
            case 100:
                $date = date('Y-m-d');
                $insert = "INSERT INTO feedback(user_id,user_type,message,submit_date)values('$data[userId]','$data[userType]','$data[message]','$date');";
                break;
            default :
                $response = ["status" => 2, "content" => ""];
                return $response;
        }
        try { 
            $result = $con->createCommand($insert)->execute();
            $response = ["status" => 1, "content" => $result];
            return $response;
            $con->close();
        } catch (yii\db\Exception $e) {
            $response = ["status" => 0, "content" => $e];
            $con->close();
            return $response;
        }
    }

    public function getStates($idx) 
    {
        $con = \Yii::$app->db;
        $response = [];
        switch ($idx) {
            case 100:
                $query = "SELECT id as stateId,name as stateName
                    from state ;";
                break;
            default :
                $response = ["status" => 2, "content" => ""];
                return $response;
        }
        try { 
            $result = $con->createCommand($query)->queryAll();
            $response = ["status" => 1, "content" => $result];
            return $response;
            $con->close();
        } catch (yii\db\Exception $e) {
            $response = ["status" => 0, "content" => $e];
            $con->close();
            return $response;
        }
    }
    public function getCity($idx,$stateId) 
    {
        $con = \Yii::$app->db;
        $response = [];
        switch ($idx) {
            case 100:
                $query = "SELECT id as cityId,name as cityName
                    from city WHERE state_id = '$stateId' ;";
                break;
            default :
                $response = ["status" => 2, "content" => ""];
                return $response;
        }
        try { 
            $result = $con->createCommand($query)->queryAll();
            $response = ["status" => 1, "content" => $result];
            return $response;
            $con->close();
        } catch (yii\db\Exception $e) {
            $response = ["status" => 0, "content" => $e];
            $con->close();
            return $response;
        }
    }

    public function insertVerificationStatus($idx,$data) 
    {
        $con = \Yii::$app->db;
        $response = [];
        switch ($idx) {
            case 100:
                $bookId = isset($data['bookingId'])?$data['bookingId']:0;
                $query = "INSERT INTO  payment_verification(booking_id,razorpay_order_id,razorpay_payment_id,  razorpay_signature,status)VALUES('$bookId','$data[orderId]','$data[paymentId]','$data[siganture]','$data[status]');";
                break;
            default :
                $response = ["status" => 2, "content" => ""];
                return $response;
        }
        try { 
            $result = $con->createCommand($query)->execute();
            $response = ["status" => 1, "content" => $result];
            return $response;
            $con->close();
        } catch (yii\db\Exception $e) {
            $response = ["status" => 0, "content" => $e];
            $con->close();
            return $response;
        }
    }

    public function getAppointmentList($idx,$userId,$stage) 
    {
        $con = \Yii::$app->db;
        $response = [];
        switch ($idx) {
            case 100:
                $whereCndn = "";
                $images = 'http://investigohealth.com/uploads/';
                $today = date('Y-m-d');
                if($stage == 'upcoming'){
                    $whereCndn = " AND  app_date >= '$today' ";
                }else{
                    $whereCndn = " AND  app_date < '$today' ";
                }
                $query = "SELECT ap.id as appointmentId,ap.booking_id as bookingId,ver.razorpay_payment_id as  transactionId,ap.price as amount,ap.app_date as appointmentDate,REPLACE(ap.app_time, '-', ' To ') as appTime,hosp.user_id as hospId,hosp.name as hospName,hosp.city as city,case when hosp.hospital_clinic_image <> '' then concat('$images','hospitalClinicImage/',hosp.id,'/',hosp.id,'.',hosp.hospital_clinic_image) else '' end
                    as hospImage,
                    CASE WHEN ap.investigation_id = 0 then '' else inv.investigation_name end as invName,
                    ap.doctor_id as docId ,CASE WHEN ap.doctor_id  = 0 then '' else doc.name end as docName,
                    CASE WHEN ap.doctor_id  = 0 then '' else docspec.name end as docSpeciality,
                    CASE WHEN ap.doctor_id  = 0 then '' else doc.   experience end as docExperience,CASE when doc.profile_image <> '' then 
                    concat('$images','doctors/',doc.id,'/',doc.id,'.',doc.profile_image) else concat('$images','doctors/default.png') end as doctorImage
                    from appointments ap
                    JOIN hospital_clinic_details hosp ON hosp.user_id = ap.hospital_clinic_id
                    LEFT JOIN doctors_details doc ON doc.id = ap.doctor_id
                    LEFT JOIN  doctor_specialty_mst docspec ON docspec.id = doc.id and docspec.status = 1
                    LEFT JOIN  investigations inv ON inv.id = ap.investigation_id
                    LEFT JOIN payment_verification ver on ver.booking_id = ap.booking_id
                    WHERE patient_id = '$userId' $whereCndn /*AND SUBSTRING_INDEX
                      (app_time, '-', '1')  
                      > DATE_FORMAT(NOW(), '%r')*/ ;";
                break;
            default :
                $response = ["status" => 2, "content" => ""];
                return $response;
        }
        try { 
            $result = $con->createCommand($query)->queryAll();
            $response = ["status" => 1, "content" => $result];
            return $response;
            $con->close();
        } catch (yii\db\Exception $e) {
            $response = ["status" => 0, "content" => $e];
            $con->close();
            return $response;
        }
    }

}
