<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Posts;
use frontend\models\PostsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\Url;
use frontend\models\PostComments;

/**
 * PostsController implements the CRUD actions for Posts model.
 */
class PostsController extends Controller {

        /**
         * @inheritdoc
         */
        public function behaviors() {
                return [
                    'access' => [
                        'class' => AccessControl::className(),
                        'only' => ['create', 'Index', 'view', 'update', 'delete', 'LatestPost', 'MyPosts', 'DetailPost', 'posts'],
                        'rules' => [
                            [
                                'actions' => [''],
                                'allow' => true,
                                'roles' => ['?'],
                            ],
                            [
                                'actions' => ['create', 'Index', 'view', 'update', 'delete', 'LatestPost', 'MyPosts', 'DetailPost', 'posts'],
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
         * Lists all Posts models.
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

                        $this->layout = 'loggedstudent';
                        Yii::$app->params['active'] = 'posts';
                }
        }

        public function actionIndex() {
                $this->layout = 'loggedstudent';

                $searchModel = new PostsSearch();
                $searchModel->active = "post";
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        public function actionMyPosts() {
                $this->layout = 'loggedstudent';
                $searchModel = new PostsSearch();
                return $this->render('myPosts', [
                            'model' => $searchModel,
                ]);
        }

        /**
         * Displays a single Posts model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                return $this->render('view', [
                            'model' => $this->findModel($id),
                ]);
        }

        /**
         * Creates a new Posts model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {
                $this->layout = "loggedstudent";
                $model = new Posts();
                $model->cb = yii::$app->user->identity->id;
                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                        Yii::$app->session->setFlash('postsuccess', 'Your post added successfully!');
                        return $this->redirect(['index']);
                } else {
                        return $this->render('create', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Updates an existing Posts model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate($id) {
                $model = $this->findModel($id);
                $model->cb = yii::$app->user->identity->id;
                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                        return $this->redirect(['view', 'id' => $model->post_id]);
                } else {
                        return $this->render('update', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Deletes an existing Posts model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id) {
                $this->findModel($id)->delete();

                return $this->redirect(['index']);
        }

        /**
         * Finds the Posts model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return Posts the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = Posts::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

        public function actionLatestPost() {
                $this->layout = "loggedstudent";
                $lpost = Posts::find()->where(['status' => 1])->orderBy(['post_id' => SORT_DESC])->one();
                $opost = Posts::find()->where(['status' => 1])->andWhere(['<>', 'post_id', $lpost->post_id])->orderBy(['post_id' => SORT_DESC])->all();
                $rpost = Posts::find()->where(['status' => 1, 'sub_id' => $lpost->sub_id])->andWhere(['<>', 'post_id', $lpost->post_id])->orderBy(['post_id' => SORT_DESC])->all();
                return $this->render('latestPost', [
                            'lpost' => $lpost, 'opost' => $opost, 'rpost' => $rpost
                ]);
        }

        public function actionDetailPost($id) {
                Yii::$app->params['active'] = 'posts';
                $this->layout = "loggedstudent";

                $post = $this->findModel($id);
                $newComments = new \frontend\models\PostComments();

                $rpost = new \yii\data\ActiveDataProvider([
                    'query' => Posts::find()
                            ->Where(['status' => 1, 'topic_id' => $post->topic_id])
                            ->andWhere('post_id <>' . $id),
                    'pagination' => [
                        'pageSize' => 5,
                    ],
                ]);
                /*  $postcomments = new \yii\data\ActiveDataProvider([
                  'query' => \frontend\models\PostComments::find()->Where(['post_id' => $id, 'status' => 1]),
                  'pagination' => [
                  'pageSize' => 3,
                  ],
                  ]); */
                return $this->render('detailPost', [
                            'post' => $post, 'rpost' => $rpost, 'newComments' => $newComments,
                ]);
        }

        public function actionLoadComments($id = 0) {
                $post = PostComments::find()->where(['status' => 1, 'post_id' => $id]);
                $this->render('loadComments', ['post' => $post]);
        }

        public function actionPost() {
                $this->layout = "loggedstudent";
                $dataProvider = new ActiveDataProvider([
                    'query' => Posts::find()->where(['status' => 0])->orderBy('post_id DESC'),
                    'pagination' => [
                        'pageSize' => 3,
                    ],
                ]);
                return $this->render('postsView', ['provider' => $dataProvider]);
        }

}
