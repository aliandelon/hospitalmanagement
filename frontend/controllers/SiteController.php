<?php

namespace frontend\controllers;

use Yii;
use DateTime;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use yii\web\Response;
use frontend\models\LoginForm;
use common\models\HolidayList;

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
                                'actions' => ['login','holiday','event','error',"viewevent","viewinvestigations"],
                                'allow' => true,
                            ],
                            [
                                'actions' => ['logout', 'index','event',"viewevent","viewinvestigations"],
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

        /**
         * Displays homepage.
         *
         * @return mixed
         */
        public function actionIndex() {
            $params = [];
            return $this->render('index',['params'=>$params]);
        }


            public function actionLogin() {
                $this->layout = 'userlogin';
                if (!Yii::$app->user->isGuest) {
                        return $this->goHome();
                }
                $model = new LoginForm();
                if ($model->load(Yii::$app->request->post()) && $model->login()) {
                   
                    return $this->goBack();
                } else {
                        return $this->render('login', [
                                    'model' => $model,
                        ]);
                }
        }



        public function actionHoliday() {
            $model = new HolidayList();
            $con = \Yii::$app->db;
            $addEvents = $model->viewInvestigations($con);
            return $this->render('holiday', [
                                    'list' => $addEvents,
                        ]);
        }

        public function actionEvent() {
            $post = Yii::$app->request->post();
            $model = new HolidayList();
            $con = \Yii::$app->db;
            if($post){
                $hospital_id = Yii::$app->user->identity->id;
                $model->holiday_flag = $post['holidayFlag'];
                $model->investigation_id = $post['investigation'];
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
            $addEvents = $model->viewEvents($con, $post['hosId']);
            return json_encode($addEvents);
        }


        public function actionLogout() {
                Yii::$app->user->logout();

                return $this->goHome();
        }   

       

}
