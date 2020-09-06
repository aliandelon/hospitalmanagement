<?php

namespace frontend\controllers;

use Yii;
use frontend\models\ForumsAnswers;
use frontend\models\ForumsAnswersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ForumsAnswersController implements the CRUD actions for ForumsAnswers model.
 */
class ForumsAnswersController extends Controller {

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
         * Lists all ForumsAnswers models.
         * @return mixed
         */
        public function actionIndex() {
                $searchModel = new ForumsAnswersSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        /**
         * Displays a single ForumsAnswers model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                return $this->render('view', [
                            'model' => $this->findModel($id),
                ]);
        }

        /**
         * Creates a new ForumsAnswers model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                $model = new ForumsAnswers();
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
         * Updates an existing ForumsAnswers model.
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
         * Deletes an existing ForumsAnswers model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id) {
                $this->findModel($id)->delete();

                return $this->redirect(['index']);
        }

        /**
         * Finds the ForumsAnswers model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return ForumsAnswers the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = ForumsAnswers::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

}
