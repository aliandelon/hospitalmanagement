<?php

namespace frontend\controllers;

use Yii;
use frontend\models\PostComments;
use frontend\models\PostCommentsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * PostCommentsController implements the CRUD actions for PostComments model.
 */
class PostCommentsController extends Controller {

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
         * Lists all PostComments models.
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
                $searchModel = new PostCommentsSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        /**
         * Displays a single PostComments model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                return $this->render('view', [
                            'model' => $this->findModel($id),
                ]);
        }

        /**
         * Creates a new PostComments model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                $model = new PostComments();
                $this->layout = null;
                if ($model->load(Yii::$app->request->post())) {
                        $model->cod = date('Y-m-d H:i:s');
                        $model->cb = Yii::$app->user->identity->id;
                        $model->status = 1;

                        if ($model->save()) {
                                return ['response' => 'success', 'msg' => 'Saved'];
                        } else {
                                return ['response' => 'error', 'msg' => $model->errors];
                        }
                }
        }

        /**
         * Updates an existing PostComments model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate($id) {
                $model = $this->findModel($id);

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                        return $this->redirect(['view', 'id' => $model->comment_id]);
                } else {
                        return $this->render('update', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Deletes an existing PostComments model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id) {
                $this->findModel($id)->delete();

                return $this->redirect(['index']);
        }

        /**
         * Finds the PostComments model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return PostComments the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = PostComments::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

}
