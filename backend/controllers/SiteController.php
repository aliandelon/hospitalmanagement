<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\Students;
use backend\models\Topics;
use backend\models\Posts;
use backend\models\Forms;
use common\models\Login;
use common\models\DoctorsDetails;
use common\models\Appointments;
use common\models\Investigations;
use common\models\Banners;

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
                                'actions' => ['login', 'error'],
                                'allow' => true,
                            ],
                            [
                                'actions' => ['logout', 'index'],
                                'allow' => true,
                                'roles' => ['@'],
                            ],
                        ],
                    ],
                    'verbs' => [
                        'class' => VerbFilter::className(),
                        'actions' => [
                            'logout' => ['post'],
                        ],
                    ],
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
                ];
        }

        /**
         * Displays homepage.
         *
         * @return string
         */
        public function actionIndex() {
            $params = [];
            $model = new Login();
            $model1 = new DoctorsDetails();
            $model2 = new Appointments();
            $model3 = new Investigations();
            $model4 = new Banners();
            $first_day_this_month = date('Y-m-01'); // hard-coded '01' for first day
            $last_day_this_month  = date('Y-m-t');
            $params['registeredHospital'] = $model->getUserCountBasedOnTypes('3');
            $params['registeredSubAdmins'] = $model->getUserCountBasedOnTypes('2');
            $params['registeredDoctors'] = $model1->getDocCount();
            $params['registeredPatients'] =  $model->getUserCountBasedOnTypes('4');
            $params['totalAppointments'] =  $model2->getAppointmentCount();
            $params['totalInvestigations'] =  $model3->getInvestigationCount();
            $params['totalInvestigationsMonthwise'] =  $model3->getInvestigationMonthwiseCount();
            $params['totalDocAppointmentsMonthwise'] = $model1->getDoctorMonthwiseCount();
            $params['totalBanners'] =  $model4->getBannerCount();
            $params['activeHospital'] = $model->getUserCountBasedOnTypes('3','1');
            $params['topRatedHospital'] = $model2->getTopRatedHospitals($first_day_this_month,$last_day_this_month);
            $params['topRatedDoctors'] = $model2->getTopRatedDoctors($first_day_this_month,$last_day_this_month);
            $params['topRatedInvestigation'] = $model2->getTopRatedInvestigations($first_day_this_month,$last_day_this_month);
        	return $this->render('index',['params'=>$params]);
        }

        /**
         * Login action.
         *
         * @return string
         */
        public function actionLogin() {
                $this->layout = 'adminlogin';
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

        /**
         * Logout action.
         *
         * @return string
         */
        public function actionLogout() {

                Yii::$app->user->logout();

                return $this->goHome();
        }

       

}
