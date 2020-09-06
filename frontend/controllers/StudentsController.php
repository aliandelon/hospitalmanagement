<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Students;
use frontend\models\StudentsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use frontend\models\Studying;
use yii\web\Response;
use yii\filters\AccessControl;

class StudentsController extends Controller {

        public function behaviors() {
                return [
                    'access' => [
                        'class' => AccessControl::className(),
                        'rules' => [
                            [
                                'actions' => [''],
                                'allow' => true,
                                'roles' => ['?'],
                            ],
                            [
                                'actions' => ['my-account', 'my-profile', 'update'],
                                'allow' => true,
                                'roles' => ['@'],
                            ],
                        ],
                    ],
                    'verbs' => [
                        'class' => VerbFilter::className(),
                        'actions' => [
                            'delete' => ['POST'],
                        ],
                    ],
                ];
        }

        /**
         * Lists all Students models.
         * @return mixed
         */
        public function init() {
                if (!isset(Yii::$app->user->identity)) {
                        $this->redirect(Url::base() . '/site/login');
                }
        }

        public function actionIndex() {
                $searchModel = new StudentsSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        /**
         * Displays a single Students model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                return $this->render('view', [
                            'model' => $this->findModel($id),
                ]);
        }

        /**
         * Creates a new Students model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {
                $model = new Students();
                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                        return $this->redirect(['view', 'id' => $model->stud_id]);
                } else {
                        return $this->render('create', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Updates an existing Students model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate() {
                $this->layout = "loggedstudent";
                $model = $this->findModel(yii::$app->user->identity->id);
                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                        return $this->redirect(['my-profile']);
                } else {
                        return $this->render('update', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Deletes an existing Students model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id) {
                $this->findModel($id)->delete();

                return $this->redirect(['index']);
        }

        /**
         * Finds the Students model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return Students the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = Students::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

        /// Logged in

        public function actionMyAccount() {
                $this->layout = 'loggedstudent';
                $model = Students::find()->where(['id' => Yii::$app->user->identity->id])->one();
                $currentPlan = \frontend\models\StudentPlan::find()->where(['student_id' => Yii::$app->user->identity->id])->one();
                if (!empty($model)) {
                        if (!empty($currentPlan)) {
                                return $this->render('myAccount', [
                                            'model' => $model, 'currentPlan' => $currentPlan
                                ]);
                        } else {
                                return $this->render('plansView', [
                                            'model' => $model, 'plans' => new \frontend\models\Plans()
                                ]);
                        }
                } else {
                        $this->redirect(['site/login']);
                }
        }

        public function actionMyProfile() {
                $this->layout = 'loggedstudent';
                $model = Students::findOne(Yii::$app->user->identity->id);
                if (!empty($model)) {
                        return $this->render('myProfile', [
                                    'model' => $model,
                        ]);
                } else {
                        $this->redirect(['site/login']);
                }
        }

        public function actionStartStudying() {
                $this->layout = 'loggedstudent';
                $model = new Studying();
                return $this->redirect(['subjects/list-subjects', 'sem_id' => $semester]);
        }

        public function actionSemester() {
                $this->layout = null;
                \yii::$app->response->format = Response::FORMAT_JSON;
                $sem = [];
                if (isset($_POST['year']) && $_POST['year'] > 0) {
                        $sem = ArrayHelper::map(\backend\models\Semesters::find()->where(['year_id' => $_POST['year']])->all(), 'sem_id', 'sem_name');
                        return ['response' => 'success', 'sem' => $sem];
                } else {
                        return ['response' => 'error', 'sem' => $sem];
                }
        }

}
