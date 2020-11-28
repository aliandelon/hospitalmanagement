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
use Razorpay\Api\Api;

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
                'verify-mobile','verify-otp','set-userdetails'
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
	        if ( $getUserDetails && !empty($getUserDetails['userData']))
	        {
                try {
                    $response['status']  = "success";
                    $response['message'] = 'User details get success';
                    $response['content'] = $getUserDetails;
                }catch (yii\base\ErrorException $e) {
                    $response['status']  = "error";
                    $response['message'] = $e->getMessage();
                    return $response;
                }
	        }else{
                $response['status']  = "failure";
                $response['message'] = 'User details get failure';
                $response['content'] = $getUserDetails;
            }
            return $response;
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
                    return $response;
                }
                return $response;
            }
        }catch (yii\base\ErrorException $e) {
            return $e;
        }
    }

    public function actionVerifyOtp($idx, $otp, $userId,$mobile,$firebaseToken)
    {
        try
        {
            $response = [];
            $model = new ApiModel();
            $getUserDetails = $model->getVerifyOtp($idx, $otp, $userId, $mobile, $firebaseToken);
            if ( $getUserDetails )
            {
                if($getUserDetails['status'] == 1)
                {
                    try {
                        $response['status']  = "success";
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
                        ->expiresAt($time + (24*60*60))
                        ->withClaim('uid', $userId)
                        ->getToken($signer, $key);
                        $response['content']['isInitialProfileDone'] = 'Yes';
                        $response['content']['token'] = (string)$token;
                    }catch (yii\base\ErrorException $e) {
                        $response['status']  = "error";
                        $response['message'] = $e->getMessage();
                        return $response;
                    }
                }else{
                    $response['status']  = "failure";
                    $response['content']['isInitialProfileDone'] = 'No';
                    $response['content'] = $getUserDetails;
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
                    $response['content']['userData'] = $setUserDetails['content'];
                    $response['content']['status'] = 1;
                    $response['status']  = "success";
                    $response['message'] = "user detail updated successfully";
                }catch (yii\base\ErrorException $e) {
                    $response['status']  = "error";
                    $response['message'] = $e->getMessage();
                    $response['content'] = [];
                    return $response;
                }
                return $response;
            }else{
                return $setUserDetails;
            }
            //$this->setResponseFormat(1);
        }catch (yii\base\ErrorException $e) {
            return $e;
        }
    }

    public function actionGetHospitalLabsList()
    {  
        try
        {
            $response = [];
            ini_set('memory_limit', '-1');
            $model = new ApiModel();
            $rawData  = self::readData();
            $inputData = $rawData;
            $getHospitalClinic = $model->getHospitalLabsDetails($inputData);
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
            }else{
                $response['content']  = $getHospitalClinic;
                return $response;
            }
            $this->setResponseFormat(1);
        }catch (yii\base\ErrorException $e) {
            return $e;
        }
    }

    public function actionGetHospitalDetails()
    {  
        try
        {
            $response = [];
            ini_set('memory_limit', '-1');
            $model = new ApiModel();
            $rawData  = self::readData();
            $inputData = $rawData;
            $getHospitalClinic = $model->getHospitalDetails($inputData);
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

    // public function actionGetLabDetails()
    public function actionGetLaboratoryDetails()
    {  
        try
        {
            $response = [];
            ini_set('memory_limit', '-1');
            $model = new ApiModel();
            $rawData  = self::readData();
            $inputData = $rawData;
            $getHospitalClinic = $model->getLabDetails($inputData);
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

    public function actionGetLaboratorySlotdetails()
    {  
        // try
        // {
            $response = [];
            ini_set('memory_limit', '-1');
            $model = new ApiModel();
            $rawData  = self::readData();
            $inputData = $rawData;
            $getHospitalClinic = $model->getLaboratorySlotdetails($inputData);
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
        // }catch (yii\base\ErrorException $e) {
        //     return $e;
        // }
    }

    public function actionGetDoctorSlotdetails()
    {  
        try
        {
            $response = [];
            ini_set('memory_limit', '-1');
            $model = new ApiModel();
            $rawData  = self::readData();
            $inputData = $rawData;
            $getHospitalClinic = $model->getDoctorSlotdetails($inputData);
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
            }else if ( $getHospitalClinic && $getHospitalClinic['status'] == 2)
            {
                $response['status']  = "failure";
                $response['message'] = 'Slot Already Booked';
                $response['alradyBookedAppoinments'] = $getHospitalClinic['alradyBookedAppoinments'];
                $response['booking_status'] = $getHospitalClinic['booking_status'];
                $response['total_amount_to_pay'] = $getHospitalClinic['total_amount_to_pay'];
                 return $response;
            }else{
                $response['status']  = "failure";
                $response['message'] = '';
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
            ->expiresAt($time +(24*60*60)) // Configures the expiration time of the token (exp claim)
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
                    $response['content']['userData'] = $setUserDetails['content'];
                    $response['content']['status'] = 1;
                    $response['status']  = "success";
                    $response['message'] = "User details updated successfully";
                }catch (yii\base\ErrorException $e) {
                    $response['status']  = "error";
                    $response['message'] = 'failue in user detrails updation';
                    return $response;
                }
                return $response;
            }else{
                $response['status']  = "error";
                $response['message'] = "failure in registering";
                $response['content'] = $setUserDetails['msg'];
                return $response;
            }
            //$this->setResponseFormat(1);
        }catch (yii\base\ErrorException $e) {
            return $e;
        }
    }
    public function actionSetfeedback()
    {  
        try
        {
            $response = [];
            ini_set('memory_limit', '-1');
            $model = new ApiModel();
            $rawData  = self::readData();
            $inputData = $rawData;
            $setFeedBack = $model->setFeedBack($inputData);
            if ( $setFeedBack && $setFeedBack['status'] == 1)
            {
                try {
                    $response['status']  = "success";
                    $response['content'] = $setFeedBack;
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
    public function actionGetStates($idx)
    {  
        try
        {
            $response = [];
            ini_set('memory_limit', '-1');
            $model = new ApiModel();
            $getStates = $model->getStates($idx);
            if ( $getStates && $getStates['status'] == 1)
            {
                try {
                    $response['status']  = "success";
                    $response['content'] = $getStates;
                }catch (yii\base\ErrorException $e) {
                    $response['status']  = "error";
                    $response['message'] = $e->getMessage();
                    return $response;
                }
            }else{
                $response['status']  = "failure";
                $response['content'] = $getStates;
            }
            return $response;
            $this->setResponseFormat(1);
        }catch (yii\base\ErrorException $e) {
            return $e;
        }
    }

    public function actionGetCity($idx,$stateId)
    {  
        try
        {
            $response = [];
            ini_set('memory_limit', '-1');
            $model = new ApiModel();
            $getCity = $model->getCity($idx,$stateId);
            if ( $getCity && $getCity['status'] == 1)
            {
                try {
                    $response['status']  = "success";
                    $response['content'] = $getCity;
                }catch (yii\base\ErrorException $e) {
                    $response['status']  = "error";
                    $response['message'] = $e->getMessage();
                    return $response;
                }
            }else{
                $response['status']  = "failure";
                $response['content'] = $getCity;
            }
            return $response;
            $this->setResponseFormat(1);
        }catch (yii\base\ErrorException $e) {
            return $e;
        }
    }
    public function actionPaymentVerification()
    {  
        try
        {
            $response = [];
            ini_set('memory_limit', '-1');
            $model = new ApiModel();
            $rawData  = self::readData();
            $inputData = $rawData;
            $idx = $inputData['idx'];
            $api = new Api($key_id='rzp_test_bTrHANOgDU4a8o', $key_secret='kIgswUqnhz1iGTA38M5hiZSN');
            $attributes  = array('razorpay_order_id' => $inputData['orderId'],'razorpay_payment_id'  => $inputData['paymentId'] ,'razorpay_signature'=>$inputData['siganture']);
            try {
                $order  = $api->utility->verifyPaymentSignature($attributes);
                if($order == "failed")
                {
                    $response['status']  = "Invalid signature passed";
                    $inputData['status'] = 0;
                }else{
                    $response['status']  = "success";
                    $inputData['status'] = 1;
                }
                $insertVerificationStatus = $model->insertVerificationStatus($idx,$inputData);
            }catch (yii\base\ErrorException $e) {
                $response['status']  = "error";
                $response['message'] = $e->getMessage();
                return $response;
            }
            return $response;
            $this->setResponseFormat(1);
        }catch (yii\base\ErrorException $e) {
            return $e;
        }
    }
    public function actionGetAppointmentList($idx,$userId,$stage)
    {  
        try
        {
            $response = [];
            ini_set('memory_limit', '-1');
            $model = new ApiModel();
            $getAppointmentList = $model->getAppointmentList($idx,$userId,$stage);
            if ( $getAppointmentList && $getAppointmentList['status'] == 1)
            {
                try {
                    $response['status']  = "success";
                    $response['content'] = $getAppointmentList;
                }catch (yii\base\ErrorException $e) {
                    $response['status']  = "error";
                    $response['message'] = $e->getMessage();
                    return $response;
                }
            }else{
                $response['status']  = "failure";
                $response['content'] = $getAppointmentList;
            }
            return $response;
            $this->setResponseFormat(1);
        }catch (yii\base\ErrorException $e) {
            return $e;
        }
    }

    public function actionCancelAppointment()
    {  
        try
        {
            $response = [];
            ini_set('memory_limit', '-1');
            $model = new ApiModel();
            $rawData  = self::readData();
            $inputData = $rawData;
            $cancelAppointment = $model->cancelAppointment($inputData);
            if ( $cancelAppointment && $cancelAppointment['status'] == 1)
            {
                try {
                    $response['status']  = "success, Appointment Cancelled";
                    $response['content'] = $cancelAppointment;
                }catch (yii\base\ErrorException $e) {
                    $response['status']  = "error";
                    $response['message'] = $e->getMessage();
                    return $response;
                }
            }else{
                $response['status']  = "failure";
                $response['content'] = $cancelAppointment;
            }
            return $response;
            $this->setResponseFormat(1);
        }catch (yii\base\ErrorException $e) {
            return $e;
        }
    }
}
