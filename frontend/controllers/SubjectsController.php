<?php

namespace frontend\controllers;

use yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use backend\models\Chapters;
use yii\helpers\Url;

class SubjectsController extends \yii\web\Controller {

        public function behaviors() {
                return [
                    'access' => [
                        'class' => AccessControl::className(),
                        'only' => ['ListSubjects'],
                        'rules' => [
                            [
                                'actions' => [],
                                'allow' => true,
                                'roles' => ['?'],
                            ],
                            [
                                'actions' => ['index', 'ListSubjects', 'ListSubjectsById'],
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
                        $this->layout = 'loggedstudent';
                }
        }

        public function actionIndex() {
                return $this->render('index');
        }

        public function actionListSubjects() {

                $defaultsubject = [];
                $this->layout = 'loggedstudent';
                $subjects = \backend\models\Subjects::find()->select(['sub_id', 'sub_name', 'status'])->where(['status' => 1])->orderBy(['sort' => SORT_ASC])->all();

                foreach ($subjects as $key) {
                        $defaultsubject = Chapters::find()->select(['chapter_id', 'chapter_name'])->where(['status' => 1, 'sub_id' => $key['sub_id']])->orderBy(['sort' => SORT_ASC])->all();
                        if (!empty($defaultsubject)) {
                                break;
                        } else {
                                continue;
                        }
                }
                return $this->render('listSubjects', ['subjects' => $subjects, 'defaultsubject' => $defaultsubject]);
        }

        public function actionListSubjectsById() {
                $defaultsubject = [];
                $this->layout = NULL;
                if (filter_input(INPUT_POST, 'sub') !== null && filter_input(INPUT_POST, 'sub') != "") {
                        $subject = explode('_', filter_input(INPUT_POST, 'sub'));
                        $subid = end($subject);


                        if (isset($subid) && $subid > 0) {
                                $defaultsubject = Chapters::find()->select(['chapter_id', 'chapter_name'])->where(['status' => 1, 'sub_id' => $subid])->orderBy(['sort' => SORT_ASC])->all();
                        }
                }
                return $this->renderAjax('_chapterView', ['defaultsubject' => $defaultsubject]);
        }

        public function actionTopicsWatch() {
                $this->layout = 'loggedstudent';
                $chapters = [];
                $topicView = "";
                if (isset($_GET['topicid']) && $_GET['topicid'] > 0) {
                        $topicView = $_GET['topicid'];
                }
                if (isset($_GET['subid']) && $_GET['subid'] > 0) {
                        $chapters = \backend\models\Chapters::find()->select(['chapter_id', 'chapter_name'])->where(['status' => 1, 'sub_id' => $_GET['subid']])->orderBy(['sort' => SORT_ASC])->all();
                }
                return $this->render('chapterMain', ['chapters' => $chapters, 'topicView' => $topicView]);
        }

        public function actionRenderTopicById() {
                $this->layout = null;
                $topicView = 0;
                if (isset($_POST['topicView']) && $_POST['topicView'] > 0) {
                        $topicView = $_POST['topicView'];
                }
                return $this->renderAjax('_chapterTopicViewById', ['topicView' => $topicView]);
        }

        public function actionTest() {
                $this->layout = 'loggedstudent';
                if (yii::$app->session->has('currentSem') && yii::$app->session->get('currentSem') > 0) {
                        $subjects = \backend\models\Subjects::find()->select(['sub_id', 'sub_name'])->where(['status' => 1, 'sem_id' => Yii::$app->session->get('currentSem')])->orderBy(['sub_name' => SORT_ASC])->all();
                        foreach ($subjects as $key) {
                                $defaultsubject = \backend\models\Chapters::find()->select(['chapter_id', 'chapter_name'])->where(['status' => 1, 'sub_id' => $key['sub_id']])->all();
                                if (!empty($defaultsubject)) {
                                        break;
                                } else {
                                        continue;
                                }
                        }
                        return $this->render('listSubjectsTest', ['subjects' => $subjects, 'defaultsubject' => $defaultsubject]);
                } else {
                        return $this->render('startStudying', ['model' => new Studying()]);
                }
        }

        public function actionStartTest() {
                $this->layout = 'loggedstudent';
                if (isset($_GET['test_id']) && $_GET['test_id'] > 0) {
                        $testid = $_GET['test_id'];
                        yii::$app->session->set('currenttest', $testid);
                }
                if (isset($_GET['chapterid']) && $_GET['chapterid'] > 0) {
                        yii::$app->session->set('currentchapter', $_GET['chapterid']);
                        $tests = \backend\models\Test::find()->select(['test_id', 'test_name'])->where(['status' => 1, 'chapter_id' => $_GET['chapterid']])->orderBy(['test_name' => SORT_ASC])->all();
                }
                return $this->render('testMain');
        }

}
