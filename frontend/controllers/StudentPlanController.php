<?php

namespace frontend\controllers;

use Yii;
use frontend\models\StudentPlan;
use frontend\models\StudentPlanSearch;
use backend\models\Plans;
use frontend\models\Students;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StudentPlanController implements the CRUD actions for StudentPlan model.
 */
class StudentPlanController extends Controller {

        /**
         * @inheritdoc
         */
        public function behaviors() {
                return [
                    'verbs' => [
                        'class' => VerbFilter::className(),
                        'actions' => [
                            'delete' => ['POST'],
                        ],
                    ],
                ];
        }

        /**
         * Lists all StudentPlan models.
         * @return mixed
         */
        /* public function init() {

          if (!isset(Yii::$app->user->identity)) {
          $this->redirect(\yii\helpers\Url::base() . '/site/login');
          } elseif (Yii::$app->user->identity->role != 1) {
          $this->redirect(Url::base() . '/site/login');
          } elseif (!Yii::$app->studentsLog->checktokenstate(Yii::$app->user->identity->id, Yii::$app->session['multi_token'])) {
          Yii::$app->studentsLog->loging(Yii::$app->user->identity->id, 'logged out');
          Yii::$app->user->logout();
          Yii::$app->parent->logout();
          return $this->goHome();
          } else {

          $this->layout = 'loggedstudent';
          }
          } */

        public function actionIndex() {
                $searchModel = new StudentPlanSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        /**
         * Displays a single StudentPlan model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                return $this->render('view', [
                            'model' => $this->findModel($id),
                ]);
        }

        /**
         * Creates a new StudentPlan model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {
                $model = new StudentPlan();

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                } else {
                        return $this->render('create', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Updates an existing StudentPlan model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate($id) {
                $model = $this->findModel($id);

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                } else {
                        return $this->render('update', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Deletes an existing StudentPlan model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id) {
                $this->findModel($id)->delete();

                return $this->redirect(['index']);
        }

        /**
         * Finds the StudentPlan model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return StudentPlan the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = StudentPlan::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

        public function actionAllPlans($id) {

                $allplans = Plans::find()->all();

                return $this->render('choosePlan', [
                            'allplans' => $allplans,
                            'id' => $id,
                ]);
        }

        public function actionPlanDetails() {
                $model = new StudentPlan();
                $student_id = $_GET['id'];
                $plan_id = $_GET['plan_id'];


                $student_details = \frontend\models\Students::find()->where(['id' => $student_id])->one();
                $plan_details = \backend\models\Plans::find()->where(['plan_id' => $plan_id])->one();
                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                        //  $mailreturn = $this->sendMail($model, $student_details);

                        if ($this->sendMail($model, $student_details)) {
                                return $this->redirect(['site/login']);
                        } else {
                                $student_details->delete();
                                $model->delete();
                                // Yii:$app->session->setFlash('error', 'Error');
                                return $this->redirect(['site/login']);
                        }
                } else {
//                        echo '<pre/>';
//                        print_r($model);
//                        exit;
                        return $this->render('studentPlanDetails', ['studentdetails' => $student_details, 'model' => $model, 'plandetails' => $plan_details]);
                }
        }

        public function sendMail($model, $student_details) {


                \Yii::$app->mailer->compose('registerMailWithPayment', ['model' => $model, 'student_details' => $student_details])
                        ->setFrom([\Yii::$app->params['supportEmail'] => 'mastermbbslearn@gmail.com'])
                        ->setTo($student_details->user_id)
                        ->setSubject('Welcome to mastermbbs')
                        ->send();
                return true;
        }

        public function actionChoosePlan($id) {
                $this->layout = 'loggedstudent';
                $model = new StudentPlan();
                $planDetails = \frontend\models\Plans::find()->where(['plan_id' => $id])->one();
                $studentdetails = \frontend\models\Students::find()->where(['id' => Yii::$app->user->identity->id])->one();
                $model->free_trial = 0;
                $model->status = 0;
                $model->cod = date('Y-m-d:H:i:s');
                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                        return $this->redirect(['students/my-account']);
                }
                return $this->render('choosePlan', [
                            'model' => $model, 'planDetails' => $planDetails, 'studentdetails' => $studentdetails
                ]);
        }

        public function actionMyPlan() {
                $this->layout = 'loggedstudent';
                $currentPlan = StudentPlan::find()->where(['student_id' => Yii::$app->user->identity->id])->one();
                if (!empty($currentPlan)) {
                        return $this->render('myPlan', [
                                    'currentPlan' => $currentPlan
                        ]);
                } else {
                        return $this->render('plansView');
                }
        }

}
