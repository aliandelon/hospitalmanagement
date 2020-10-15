<?php

namespace frontend\controllers;

use Yii;
use DateTime;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\DoctorsDetails;
use yii\web\Response;
use frontend\models\LoginForm;
use common\models\HolidayList;
use common\models\HospitalClinicDetails;
use common\models\Appointments;
use common\models\HospitalInvestigationMapping;
use common\models\SlotDayTimeMapping;

/**
 * Site controller
 */
class SiteController extends Controller {

        /**
         * @inheritdoc
         */
        public function behaviors() {
                return [
                    'access' => [
                        'class' => AccessControl::className(),
                        'rules' => [
                            [
                                'actions' => ['login','holiday','event','error',"viewevent","viewinvestigations","publish","privacaypolicy","termsandcondition"],
                                'allow' => true,
                            ],
                            [
                                'actions' => ['logout', 'index','event',"viewevent","viewinvestigations","publish","payment"],
                                'allow' => true,
                                'roles' => ['@'],
                            ],
                        ],
                    ],
                    // 'verbs' => [
                    //     'class' => VerbFilter::className(),
                    //     'actions' => [
                    //         'logout' => ['post'],
                    //     ],
                    // ],
                ];
        }

        /**
         * @inheritdoc
         */
        public function actions() {
                return [
                    'error' => [
                        'class' => 'yii\web\ErrorAction',
                    ],
                    // 'captcha' => [
                    //     'class' => 'yii\captcha\CaptchaAction',
                    //     'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                    // ],
                ];
        }

        public function beforeAction($action) {
            $this->enableCsrfValidation = false;
            return parent::beforeAction($action);
        }

       
        // public function actionIndex() {
        //     $params = [];
        //     $permission=HospitalClinicDetails::find()->where(['user_id'=>Yii::$app->user->identity->id])->one();
        //     if(!empty($permission)){
        //         if($permission->status=="4"){
        //           return $this->redirect(['hospital-clinic-details/update2?id='.$permission->id]);
                 
        //         }else if($permission->status=="3"){

        //         }else if($permission->status=="2"){

        //         }else if($permission->status=="1"){
        //           return $this->render('index',['params'=>$params]);
        //         }
        //     }
            
        // }


            public function actionLogin() {
                
                $this->layout = 'loginNew2';
                if (!Yii::$app->user->isGuest) {
                        return $this->goHome();
                }
                $model = new LoginForm();
                if ($model->load(Yii::$app->request->post()) && $model->login()) {
                   
                    return $this->goBack();
                } else {
                        return $this->render('login-latest', [
                                    'model' => $model,
                        ]);
                }
        }



        public function actionHoliday() {
            $model = new HolidayList();
            $myModel = new DoctorsDetails();
            $con = \Yii::$app->db;
            $hospital_id = Yii::$app->user->identity->id;
            $doctors = $myModel->viewDoctors($con,$hospital_id);
            $addEvents = $model->viewInvestigations($con);
            return $this->render('holiday', [
                                    'list' => $addEvents,'doctors' => $doctors
                        ]);
        }

        public function actionEvent() {
            $post = Yii::$app->request->post();
            $model = new HolidayList();
            $con = \Yii::$app->db;
            if($post){
                $hospital_id = Yii::$app->user->identity->id;
                $model->holiday_flag = $post['holidayFlag'];
                if($model->holiday_flag!=1){
                    $model->appointment_type = $post['appointType'];
                    if($model->appointment_type!=1){
                        $model->investigation_id = $post['investigation'];
                        $model->doctor_id = 0;
                    }else{
                        $model->doctor_id = $post['doctor'];
                        $model->investigation_id = 0;
                    }
                }else{
                    $model->appointment_type = 0;
                    $model->doctor_id = 0;
                    $model->investigation_id = 0;
                }
                $model->hospital_id = $hospital_id;
                $model->reason = $post['name'];
                $date = date_create($post['eDate']);
                $source = str_replace('/', '-',$post['eDate']);
                $date = new DateTime($source);
                $model->holiday_date = $date->format('Y-m-d'); 
                // $addEvents = $model->addEvents($con, $model);
                if($model->save()){
                    return "Success";
                }else{
                    print_r($model->getErrors());exit;
                }
            }
            
        }

        public function actionViewevent() {
            $post = Yii::$app->request->post();
            $model = new HolidayList();
            $con = \Yii::$app->db;
            $hospital_id = Yii::$app->user->identity->id;
            $addEvents = $model->viewEvents($con, $hospital_id);
            return json_encode($addEvents);
        }


        public function actionLogout() {
                Yii::$app->user->logout();

                return $this->goHome();
        }   

        public function actionPublish() {
            $post = Yii::$app->request->post();
            $model = new HolidayList();
            $hospital_id = Yii::$app->user->identity->id;
            if($post['publishFlag']==1){
                $publish = $model->publish($hospital_id);
                $publish = $publish[0]['flag'];
            }else{
                $publish = 0;
            }
            $published = $model->published($publish,$hospital_id);
            return $publish;
            // return json_encode($addEvents);
        }
       
        public function actionPayment() {
            $api_key='rzp_test_QXEhrosnKHyZqA';

            return $this->render('payment', ['apikey' => $api_key]);
        }
        public function actionPrivacaypolicy() {
            $this->layout = 'loginNew';
            return $this->render('privacaypolicy.html');
        }
        public function actionTermsandcondition() {
            $this->layout = 'loginNew';
            return $this->render('termsandcondition.html');
        }
         /**
         * Displays homepage.
         *
         * @return mixed
         */
        public function actionIndex() {
            $params = [];
            $permission=HospitalClinicDetails::find()->where(['user_id'=>Yii::$app->user->identity->id])->one();
            if(!empty($permission)){
                if($permission->status=="4"){
                  return $this->redirect(['hospital-clinic-details/update2?id='.$permission->id]);
                 
                }else if($permission->status=="3"){

                }else if($permission->status=="2"){

                }else if($permission->status=="1"){
                  $model1 = new DoctorsDetails();
                  $model2 = new Appointments();
                  $model3 = new HospitalInvestigationMapping();
                  $model4 = new SlotDayTimeMapping();
                  $params['ourDoctors'] = $model1->getOurDoctorsCount();
                  $params['ourAppointments'] = $model2->getOurAppointmentCount();
                  $params['ourPatients'] = $model2->getOurPatientsCount();
                  $params['ourInvestigations'] = $model3->getOurInvestigationCount();
                  $params['investigationEarning'] = $model4->getTotalInvestigationEarnings();
                  $params['appointmentEarning'] = $model4->getTotalAppointmentsEarnings();
                  // echo "<pre>";print_r($params);exit;
                  $monthArr = array('1' => 'Jan','2' => 'Feb', '3' => 'Mar', '4' => 'Apr', '5' => 'May', '6' => 'Jun', '7' => 'Jul', '8' => 'Aug', '9' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec' );
                  $amount = array('Jan' => '0','Feb' => '0' , 'Mar'=> '0' , 'Apr' => '0' , 'May' => '0' , 'Jun' => '0' , 'Jul' => '0' , 'Aug' => '0' , 'Sep' => '0' , 'Oct' => '0' , 'Nov' => '0' , 'Dec' => '0' );
                  $count = array('Jan' => '0','Feb' => '0' , 'Mar'=> '0' , 'Apr' => '0' , 'May' => '0' , 'Jun' => '0' , 'Jul' => '0' , 'Aug' => '0' , 'Sep' => '0' , 'Oct' => '0' , 'Nov' => '0' , 'Dec' => '0' );
                  foreach ($params['investigationEarning'] as $key => $value) {
                    if(in_array($value['month'], $monthArr)){
                        $amount[$value['month']] = $value['amt'];
                        $count[$value['month']] = $value['count'];
                    }
                  }
                    $graphArr = [];
                    $graphArr['amt'] = implode(',', $amount);
                    $graphArr['cnt'] = implode(',', $count);
                    $params['graph1'] = $graphArr;
                  $monthArr = array('1' => 'Jan','2' => 'Feb', '3' => 'Mar', '4' => 'Apr', '5' => 'May', '6' => 'Jun', '7' => 'Jul', '8' => 'Aug', '9' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec' );
                  $amount = array('Jan' => '0','Feb' => '0' , 'Mar'=> '0' , 'Apr' => '0' , 'May' => '0' , 'Jun' => '0' , 'Jul' => '0' , 'Aug' => '0' , 'Sep' => '0' , 'Oct' => '0' , 'Nov' => '0' , 'Dec' => '0' );
                  $count = array('Jan' => '0','Feb' => '0' , 'Mar'=> '0' , 'Apr' => '0' , 'May' => '0' , 'Jun' => '0' , 'Jul' => '0' , 'Aug' => '0' , 'Sep' => '0' , 'Oct' => '0' , 'Nov' => '0' , 'Dec' => '0' );
                  foreach ($params['appointmentEarning'] as $key => $value) {
                    if(in_array($value['month'], $monthArr)){
                        $amount[$value['month']] = $value['amt'];
                        $count[$value['month']] = $value['count'];
                    }
                  }
                    $graphArr = [];
                    $graphArr['amt'] = implode(',', $amount);
                    $graphArr['cnt'] = implode(',', $count);
                    $params['graph2'] = $graphArr;
                    $params['doctorSummary'] = $model1->getDoctorSummary(Yii::$app->user->identity->id);
                    $params['doctorsView'] = $model1->viewDoctorsDashboard(Yii::$app->user->identity->id);
                    $params['investigationSummary'] = $model2->getInvestigationSummary(Yii::$app->user->identity->id,10);

                  // echo '<pre>';print_r($params);exit;
                  return $this->render('index',['params'=>$params]);
                }
            }
            
        }
}
