<?php

namespace backend\controllers;

use Yii;
use common\models\ApiModel;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ApiController For Api creaetion.
 */
class ApiController extends Controller
{
    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }
    /**
     * 
     * @return type
     * @throws yii\web\HttpException
     * 
     * 
     */
    public static function readData(){       
        $requestData = file_get_contents('php://input');
        $contentType = yii::$app->request->getContentType();
        try{
            if($contentType === 'application/xml'){
                $i='XML';
                $xmlData = simplexml_load_string($requestData);
                $data = json_decode(json_encode($xmlData), true);            
            }else if($contentType === 'application/json'){
                $i='JSON';
                $data = json_decode($requestData,true);            
            }else{
                throw new yii\web\HttpException(400,"Header->Content-Type Mismatch : Expected : application/json or application/xml : Received -> $contentType");
            }                   
        } catch (yii\base\ErrorException $e){
                throw new yii\web\HttpException(400,"INVALID $e");
        }      
        return $data;
    }    
    
    /**
     * @param type $data
     * @return int
     * @throws yii\web\HttpException
     */
    public static function processData($data)
    {
        $para = array();
        $response = array();
        $para['idx'] = ['name'=>'idx','default'=>'0','required'=>1,'condition'>''];
        $para['idx'] = ['name'=>'idx','default'=>'0','required'=>1,'condition'>''];
        try{
            foreach($data as $key => $value){
                if($value != '')
                    $response[$para[$key]['name']] = $value;
                else
                    $response[$para[$key]['name']] = $para[$key]['default'];
            }
        } catch (yii\base\ErrorException $e){
            throw new yii\web\HttpException(400,Yii::$app->params['400-invalid-parameter'].$e);
        }       
        
        return $response;
    }
    
    public static function setResponseFormat($format){
        try{
            switch ($format){
                case '1':
                    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    break;
                case '2':
                    Yii::$app->response->format = \yii\web\Response::FORMAT_XML;
                    break;
                case '3':
                    Yii::$app->response->format = \yii\web\Response::FORMAT_HTML;
                    break;
                default:
                    throw new yii\web\HttpException(400,'Invalid format');
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function actionGetUserdetails($idx, $mobile)
    {
    	try
	    {
            $response = [];
			$model = new ApiModel();
			$getUserDetails = $model->getUserDetails($idx, $mobile);
			$this->setResponseFormat(1);
	        if ( $getUserDetails )
	        {
                try {
                    $response = $getUserDetails;
                }catch (yii\base\ErrorException $e) {
                    $response['status']  = "error";
                    $response['message'] = $e->getMessage();
                    return $response;
                }
	        	return $response;
	        }
	    }catch (yii\base\ErrorException $e) {
	        return $e;
	    }
    }

     public function actionVerifyMobile($idx, $mobile)
    {
        try
        {
            $response = [];
            $model = new ApiModel();
            $getUserDetails = $model->getVerifyMobile($idx, $mobile);
            if ( $getUserDetails )
            {
                try {
                    $response['status']  = "success";
                    $response['otp'] = '1234';
                    $response['content'] = $getUserDetails;
                }catch (yii\base\ErrorException $e) {
                    $response['status']  = "error";
                    $response['message'] = $e->getMessage();
                    return json_encode($response);
                }
                return json_encode($response);
            }
        }catch (yii\base\ErrorException $e) {
            return $e;
        }
    }

    public function actionVerifyOtp($idx, $otp, $userId)
    {
        try
        {
            $response = [];
            $model = new ApiModel();
            $getUserDetails = $model->getVerifyOtp($idx, $otp, $userId);
            if ( $getUserDetails )
            {
                try {
                    $response['content'] = $getUserDetails;
                }catch (yii\base\ErrorException $e) {
                    $response['status']  = "error";
                    $response['message'] = $e->getMessage();
                    return json_encode($response);
                }
                return json_encode($response);
            }
        }catch (yii\base\ErrorException $e) {
            return $e;
        }
    }

    public function actionSetUserdetails()
    {  
        try
        {
            $response = [];
            ini_set('memory_limit', '-1');
            $model = new ApiModel();
            $rawData  = self::readData();
            /*$key = '12345678901234567890123456789012';
            $iv  = '1234567890123456';
            $method = 'AES-128-CBC';
            $rawDataDecrypted = openssl_decrypt(base64_decode(str_replace(' ', '+', $rawData['data'])), $method, $key, OPENSSL_RAW_DATA, $iv);*/
            $inputData = $rawData;
            $setUserDetails = $model->setUserDetails($inputData);
            if ( $setUserDetails && $setUserDetails['status'] == 1)
            {
                try {
                    $response['UserId'] = $setUserDetails['content'];
                    $response['status']  = "200";
                    $response['message'] = $setUserDetails['msg'];
                    // $response = !empty($setUserDetails) ? base64_encode(openssl_encrypt(json_encode($output), $method , $key, OPENSSL_RAW_DATA, $iv)) : [];
                }catch (yii\base\ErrorException $e) {
                    $response['status']  = "error";
                    $response['message'] = $e->getMessage();
                    return json_encode($response);
                }
                return json_encode($response);
            }
            $this->setResponseFormat(1);
        }catch (yii\base\ErrorException $e) {
            return $e;
        }
    }

    public function actionGetHospitalClinicDetails()
    {  
        try
        {
            $response = [];
            ini_set('memory_limit', '-1');
            $model = new ApiModel();
            $rawData  = self::readData();
            /*$key = '12345678901234567890123456789012';
            $iv  = '1234567890123456';
            $method = 'AES-128-CBC';
            $rawDataDecrypted = openssl_decrypt(base64_decode(str_replace(' ', '+', $rawData['data'])), $method, $key, OPENSSL_RAW_DATA, $iv);
            $inputData = json_decode($rawDataDecrypted,true);*/
            $inputData = $rawData;
            $getHospitalClinic = $model->getHospitalClinicDetails($inputData);
            if ( $getHospitalClinic && $getHospitalClinic['status'] == 1)
            {
                try {
                    $response['content']  = $getHospitalClinic;
                    /*$response = !empty($getHospitalClinic) ? base64_encode(openssl_encrypt($output, $method , $key, OPENSSL_RAW_DATA, $iv)) : [];*/
                }catch (yii\base\ErrorException $e) {
                    $response['status']  = "error";
                    $response['message'] = $e->getMessage();
                    return json_encode($response);
                }
                return json_encode($response);
            }
            $this->setResponseFormat(1);
        }catch (yii\base\ErrorException $e) {
            return $e;
        }
    }

    public function actionGetHospitalLabInvestigationDetails()
    {  
        try
        {
            $response = [];
            ini_set('memory_limit', '-1');
            $model = new ApiModel();
            $rawData  = self::readData();
            /*$key = '12345678901234567890123456789012';
            $iv  = '1234567890123456';
            $method = 'AES-128-CBC';
            $rawDataDecrypted = openssl_decrypt(base64_decode(str_replace(' ', '+', $rawData['data'])), $method, $key, OPENSSL_RAW_DATA, $iv);*/
            $inputData = $rawData;
            $getHospitalClinic = $model->getHospitalLabInvestigationDetails($inputData);
            if ( $getHospitalClinic && $getHospitalClinic['status'] == 1)
            {
                try {
                    $response['status']  = "success";
                    $response['content'] = $getHospitalClinic;
                    // $response = !empty($getHospitalClinic) ? base64_encode(openssl_encrypt($output, $method , $key, OPENSSL_RAW_DATA, $iv)) : [];
                }catch (yii\base\ErrorException $e) {
                    $response['status']  = "error";
                    $response['message'] = $e->getMessage();
                    return json_encode($response);
                }
                return json_encode($response);
            }
            $this->setResponseFormat(1);
        }catch (yii\base\ErrorException $e) {
            return $e;
        }
    }

    public function actionGetHospitalLabInvestigationSlotdetails()
    {  
        try
        {
            $response = [];
            ini_set('memory_limit', '-1');
            $model = new ApiModel();
            $rawData  = self::readData();
           /* $key = '12345678901234567890123456789012';
            $iv  = '1234567890123456';
            $method = 'AES-128-CBC';
            $rawDataDecrypted = openssl_decrypt(base64_decode(str_replace(' ', '+', $rawData['data'])), $method, $key, OPENSSL_RAW_DATA, $iv);*/
            $inputData = $rawData;
            $getHospitalClinic = $model->getHospitalLabInvestigationSlotdetails($inputData);
            if ( $getHospitalClinic && $getHospitalClinic['status'] == 1)
            {
                try {
                    $response['status']  = "success";
                    $response['content'] = $getHospitalClinic;
                    // $response = !empty($getHospitalClinic) ? base64_encode(openssl_encrypt($output, $method , $key, OPENSSL_RAW_DATA, $iv)) : [];
                }catch (yii\base\ErrorException $e) {
                    $response['status']  = "error";
                    $response['message'] = $e->getMessage();
                    return json_encode($response);
                }
                return json_encode($response);
            }
            $this->setResponseFormat(1);
        }catch (yii\base\ErrorException $e) {
            return $e;
        }
    }

    public function actionBookAppointment()
    {  
        try
        {
            $response = [];
            ini_set('memory_limit', '-1');
            $model = new ApiModel();
            $rawData  = self::readData();
            // $key = '12345678901234567890123456789012';
            // $iv  = '1234567890123456';
            // $method = 'AES-128-CBC';
            // $rawDataDecrypted = openssl_decrypt(base64_decode(str_replace(' ', '+', $rawData['data'])), $method, $key, OPENSSL_RAW_DATA, $iv);
            $inputData = $rawData;
            $getHospitalClinic = $model->bookAppointments($inputData);
            if ( $getHospitalClinic && $getHospitalClinic['status'] == 1)
            {
                try {
                    $response['status']  = "success";
                    $response['message'] = $getHospitalClinic;
                
                }catch (yii\base\ErrorException $e) {
                    $response['status']  = "error";
                    $response['message'] = $e->getMessage();
                    return json_encode($response);
                }
                    return json_encode($response);
            }
            $this->setResponseFormat(1);
        }catch (yii\base\ErrorException $e) {
            return $e;
        }
    }
}
