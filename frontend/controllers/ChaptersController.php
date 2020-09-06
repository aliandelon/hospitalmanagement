<?php

namespace frontend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use backend\models\Topics;
use backend\models\Chapters;

class ChaptersController extends \yii\web\Controller {

        public function behaviors() {
                return [
                    'access' => [
                        'class' => AccessControl::className(),
                        'only' => ['ListTopicsByChapter'],
                        'rules' => [
                            [
                                'actions' => ['ListTopicsByChapter'],
                                'allow' => true,
                                'roles' => ['?'],
                            ],
                            [
                                'actions' => ['index', 'ListTopicsByChapter'],
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

        public function actionListTopicsByChapter() {
                $this->layout = FALSE;
                $topics = [];
                if (filter_input(INPUT_POST, 'chapter') !== null) {

                        $query = Topics::find()->where(['status' => 1, 'chapter_id' => filter_input(INPUT_POST, 'chapter')]);
                        $topics = new ActiveDataProvider([
                            'query' => $query,
                            'pagination' => [
                                'pageSize' => 50,
                            ],
                            'sort' => [
                                'defaultOrder' => [
                                    'sort' => SORT_ASC,
                                ]
                            ],
                        ]);
                }

                return $this->renderAjax('_topicsView', ['topics' => $topics]);
        }

        public function actionListChapters() {
                $model = new Chapters();
                $this->layout = "loggedstudent";
                $chapters = [];
                $topicDetails = [];
                $posts = [];
                if (filter_input(INPUT_GET, 'chapterid') !== null && filter_input(INPUT_GET, 'chapterid') > 0) {
                        Yii::$app->params['accordion'] = 'a_panel_' . filter_input(INPUT_GET, 'chapterid');
                        $subId = Chapters::findOne(filter_input(INPUT_GET, 'chapterid'));
                        if (!empty($subId)) {
                                $chapters = \backend\models\Chapters::find()->where(['sub_id' => $subId->sub_id,'status'=>1])-> orderBy('sort ASC')->all();
                        }

                        if (filter_input(INPUT_GET, 'topicid') !== null && filter_input(INPUT_GET, 'topicid')) {
                                $topicDetails = Topics::find()->where(['topic_id' => filter_input(INPUT_GET, 'topicid')])->one();
                                $posts = new ActiveDataProvider([
                                    'query' => \frontend\models\Posts::find()->
                                            where(['topic_id' => filter_input(INPUT_GET, 'topicid')])->
                                            orderBy('sort ASC'),
                                    'pagination' => [
                                        'pageSize' => 2,
                                    ],
                                ]);
                        }

                        return $this->render('chapterView', ['chapters' => $chapters, 'topicDetails' => $topicDetails, 'posts' => $posts, 'model' => $model]
                        );
                }
        }

        public function actionTopicsVideo() {
                $topic_id = 0;
                $this->layout = FALSE;
                if (filter_input(INPUT_POST, 'topicid') !== null && filter_input(INPUT_POST, 'topicid') !== "") {

                        $topicFull = explode('_', filter_input(INPUT_POST, 'topicid'));
                        $topic_id = end($topicFull);


                        if ($topic_id > 0) {

                                $topicDetails = Topics::find()->where('topic_id=' . $topic_id)->one();
                                Yii::$app->studentsLog->loging(Yii::$app->user->identity->id, 'watching-' . $topicDetails->topic);
                                return $this->render('_topicVideoView', ['topicDetails' => $topicDetails]);
                        }
                }
        }

}
