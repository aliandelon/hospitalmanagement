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
    
    public static function chooseServer(){
        if (isset($_GET['test'])) {
            $server = 'test';
        } else {
            $server = 'live';
        }
        return $server;
    }
    public static function processData($data)
    {
        $para = array();
        $response = array();
        
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

    public function actionGetUserdetails($idx, $mob)
    {
    	try
	    {
			$model = new ApiModel();
			$getUserDetails = $model->getUserDetails($idx, $mob);
			$this->setResponseFormat(1);
	        if ( $getUserDetails )
	        {
	        	return $getUserDetails;
	        }
	    }catch (yii\base\ErrorException $e) {
	        return $e;
	    }
    }
}
