<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Testpapers;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Chapters;
use backend\models\Answers;
use backend\models\Question;

/**
 * TestpapersController implements the CRUD actions for Testpapers model.
 */
class TestpapersController extends Controller {

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
         * Lists all Testpapers models.
         * @return mixed
         */
        public function init() {

                if (!isset(Yii::$app->user->identity)) {
                        $this->redirect(Url::base() . '/site/login');
                } elseif (Yii::$app->user->identity->role != 1) {
                        $this->redirect(Url::base() . '/site/login');
                } elseif (!Yii::$app->studentsLog->checktokenstate(Yii::$app->user->identity->id, Yii::$app->session['multi_token'])) {
                        Yii::$app->studentsLog->loging(Yii::$app->user->identity->id, 'logged out');
                        Yii::$app->user->logout();
                        Yii::$app->parent->logout();
                        return $this->goHome();
                } else {
                        Yii::$app->params['active'] = 'test';
                        $this->layout = 'loggedstudent';
                }
        }

        public function actionIndex() {
                Yii::$app->params['active'] = 'test';
                $defaultsubject = [];
                $subjects = \backend\models\Subjects::find()->select(['sub_id', 'sub_name'])->where(['status' => 1])->orderBy(['sub_name' => SORT_ASC])->all();
                foreach ($subjects as $key) {
                        $defaultsubject = Chapters::find()->select(['chapter_id', 'chapter_name'])->where(['status' => 1, 'sub_id' => $key['sub_id']])->all();
                        if (!empty($defaultsubject)) {
                                break;
                        } else {
                                continue;
                        }
                }
                return $this->render('index', ['subjects' => $subjects, 'defaultsubject' => $defaultsubject]);
        }

        /**
         * Displays a single Testpapers model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                return $this->render('view', [
                            'model' => $this->findModel($id),
                ]);
        }

        /**
         * Creates a new Testpapers model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {
                $model = new Testpapers();
                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                        return $this->redirect(['view', 'id' => $model->test_id]);
                } else {
                        return $this->render('create', [
                                    'model' => $model,
                        ]);
                }
        }

        public function actionLoadTestChapters() {
                $this->layout = FALSE;
                $subid = 0;
                if (filter_input(INPUT_POST, 'subid') !== null && filter_input(INPUT_POST, 'subid') != "") {
                        $subDetails = explode('-', filter_input(INPUT_POST, 'subid'));
                        if ($subDetails[1] > 0) {
                                $subid = $subDetails[1];
                        }
                        $defaultsubject = Chapters::find()->select(['chapter_id', 'chapter_name'])->where(['status' => 1, 'sub_id' => $subid])->all();
                        return $this->renderAjax('testChapter', ['defaultsubject' => $defaultsubject]);
                } else {
                        return ['code' => '404', 'msg' => 'Method not allowed'];
                }
        }

        /**
         * Updates an existing Testpapers model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         *
         */
        public function actionUpdate($id) {
                $model = $this->findModel($id);

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                        return $this->redirect(['view', 'id' => $model->test_id]);
                } else {
                        return $this->render('update', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Deletes an existing Testpapers model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id) {
                $this->findModel($id)->delete();

                return $this->redirect(['index']);
        }

        public function actionTakeTest() {
                $this->layout = "loggedstudent";

                $model = new Testpapers();

                if (filter_input(INPUT_GET, 'chapterid') !== NULL && filter_input(INPUT_GET, 'chapterid') > 0) {
                        $chapterDetails = Chapters::find()->where(['chapter_id' => filter_input(INPUT_GET, 'chapterid')])->one();
                        $chapters = Chapters::find()->select(['chapter_id', 'chapter_name'])->where(['sub_id' => $chapterDetails->sub_id])->all();
                        $model->chpid = filter_input(INPUT_GET, 'chapterid');

                        return $this->render('takeTest', [
                                    'chapters' => $chapters, 'model' => $model, 'chapterDetails' => $chapterDetails
                        ]);
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

        public function actionCheckAnswer() {
                $this->layout = null;
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                if (filter_input(INPUT_POST, 'id') !== null && filter_input(INPUT_POST, 'id') > 0) {
                        $ans = Answers::find()->select(['option_id'])->where(['question_id' => filter_input(INPUT_POST, 'qustid')])->one();
                        $solutions = Question::find()->select(['solutions'])->where(['question_id' => filter_input(INPUT_POST, 'qustid')])->one();
                        if (count($ans) > 0) {
                                if ($ans->option_id == filter_input(INPUT_POST, 'id')) {
                                        return ['response' => '200', 'solutions' => $solutions->solutions];
                                } else {
                                        return ['response' => '201', 'solutions' => $solutions->solutions];
                                }
                        } else {
                                return ['response' => '404', 'msg' => 'Answer not found'];
                        }
                } else {
                        return ['response' => '500', 'msg' => 'Not authorised person'];
                }
        }

        /**
         * Finds the Testpapers model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return Testpapers the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = Testpapers::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

}
