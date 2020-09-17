<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use yii\web\Response;
use frontend\models\LoginForm;

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



  // public function actionTest() {
  //   echo "reach";exit;
  // }
        public function actionLogout() {
                Yii::$app->user->logout();

                return $this->goHome();
        }   

       

}
