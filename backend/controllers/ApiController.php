<?php

namespace backend\controllers;
use yii\filters\auth\HttpBearerAuth;


use Yii;
use common\models\ApiModel;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use sizeg\jwt\Jwt;
use sizeg\jwt\JwtHttpBearerAuth;

/**
 * ApiController For Api creaetion.
 */
class ApiController extends \yii\rest\Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            //'class' => JwtHttpBearerAuth::class,
            'class' => \sizeg\jwt\JwtHttpBearerAuth::class,
            'optional' => [
                'verify-mobile','register-user','verify-otp'
            ],
        ];

        return $behaviors;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['id'] === (string) $token->getClaim('uid')) {
                return new static($user);
            }
        }
        return null;
    }

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

    /**
         * @return \yii\web\Response
         */
        // public function actionData()
        // {
        //     return $this->asJson([
        //         'success' => true,
        //     ]);
        // }
    
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
                    $response['content'] = $getUserDetails['content'];
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
                    $jwt = Yii::$app->jwt;
                    $signer = $jwt->getSigner('HS256');
                    $key = $jwt->getKey();
                    $time = time();
                    $token = $jwt->getBuilder()
                    ->issuedBy('http://investigohealth.com/admin')
                    ->permittedFor('http://investigohealth.com/admin')
                    ->identifiedBy('4f1g23a12aa', true)
                    ->issuedAt($time)
                    ->expiresAt($time + 3600)
                    ->withClaim('uid', $userId)
                    ->getToken($signer, $key);
                    $response['token'] = (string)$token;
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

    public function actionSetUserdetails()
    {  
        try
        {
            $response = [];
            ini_set('memory_limit', '-1');
            $model = new ApiModel();
            $rawData  = self::readData();
            $inputData = $rawData;
            $setUserDetails = $model->setUserDetails($inputData);
            if ( $setUserDetails && $setUserDetails['status'] == 1)
            {
                try {
                    $response['UserId'] = $setUserDetails['content'];
                    $response['status']  = "200";
                    $response['message'] = $setUserDetails['msg'];
                }catch (yii\base\ErrorException $e) {
                    $response['status']  = "error";
                    $response['message'] = $e->getMessage();
                    return $response;
                }
                return $response;
            }
            //$this->setResponseFormat(1);
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
            $inputData = $rawData;
            $getHospitalClinic = $model->getHospitalClinicDetails($inputData);
            if ( $getHospitalClinic && $getHospitalClinic['status'] == 1)
            {
                try {
                    $response['content']  = $getHospitalClinic;
                }catch (yii\base\ErrorException $e) {
                    $response['status']  = "error";
                    $response['message'] = $e->getMessage();
                    return $response;
                }
                return $response;
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
            $inputData = $rawData;
            $getHospitalClinic = $model->getHospitalLabInvestigationDetails($inputData);
            if ( $getHospitalClinic && $getHospitalClinic['status'] == 1)
            {
                try {
                    $response['status']  = "success";
                    $response['content'] = $getHospitalClinic;
                }catch (yii\base\ErrorException $e) {
                    $response['status']  = "error";
                    $response['message'] = $e->getMessage();
                    return $response;
                }
                return $response;
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
            $inputData = $rawData;
            $getHospitalClinic = $model->getHospitalLabInvestigationSlotdetails($inputData);
            if ( $getHospitalClinic && $getHospitalClinic['status'] == 1)
            {
                try {
                    $response['status']  = "success";
                    $response['content'] = $getHospitalClinic;
                }catch (yii\base\ErrorException $e) {
                    $response['status']  = "error";
                    $response['message'] = $e->getMessage();
                    return $response;
                }
                return $response;
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
                    return $response;
                }
                    return $response;
            }
            $this->setResponseFormat(1);
        }catch (yii\base\ErrorException $e) {
            return $e;
        }
    }

    public function actionTest()
    { 
            $time = time();
            $token = Yii::$app->jwt->getBuilder()
            ->issuedBy('http://investigohealth.com/admin') // Configures the issuer (iss claim)
            ->permittedFor('http://investigohealth.com/admin') // Configures the audience (aud claim)
            ->identifiedBy('4f1g23a12aa', true) // Configures the id (jti claim), replicating as a header item
            ->issuedAt($time) // Configures the time that the token was issue (iat claim)
            ->canOnlyBeUsedAfter($time + 60) // Configures the time that the token can be used (nbf claim)
            ->expiresAt($time +     3600) // Configures the expiration time of the token (exp claim)
            ->withClaim('uid', 14) // Configures a new claim, called "uid"
            ->getToken(); // Retrieves the generated token
            $token->getHeaders(); // Retrieves the token headers
            $token->getClaims(); // Retrieves the token claims
            //echo $token->getHeader('jti'); // will print "4f1g23a12aa"
            //echo $token->getClaim('iss'); // will print "http://example.com"
            //  echo $token->getClaim('uid'); // will print "1"
            echo $token;
    }

    public function actionRegisterUser()
    {  
        try
        {
            $response = [];
            ini_set('memory_limit', '-1');
            $model = new ApiModel();
            $rawData  = self::readData();
            $inputData = $rawData;
            $token = '';
            $setUserDetails = $model->registerUserDetails($inputData);
            if ( $setUserDetails && $setUserDetails['status'] == 1)
            {
                try {
                    $response['UserId'] = $setUserDetails['content'];
                    $response['status']  = "200";
                    $response['message'] = $setUserDetails['msg'];
                    $response['otp'] = '1234';
                }catch (yii\base\ErrorException $e) {
                    $response['status']  = "error";
                    $response['message'] = $e->getMessage();
                    return $response;
                }
                return $response;
            }else{
                $response['status']  = "error";
                $response['message'] = "failure in registering";
            }
            //$this->setResponseFormat(1);
        }catch (yii\base\ErrorException $e) {
            return $e;
        }
    }
}
