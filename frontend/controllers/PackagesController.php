<?php

namespace frontend\controllers;

use Yii;
use common\models\Packages;
use common\models\PackagesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\HospitalClinicDetails;
/**
 * PackagesController implements the CRUD actions for Packages model.
 */
class PackagesController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
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
     * Lists all Packages models.
     * @return mixed
     */
    public function actionIndex()
    {
         $permission=HospitalClinicDetails::find()->where(['user_id'=>Yii::$app->user->identity->id])->one();
            if(!empty($permission)){
                if($permission->status=="4"){
                  $this->layout = 'notApproveLayout';
                 
                }else if($permission->status=="3"){
                  $this->layout = 'notApproveLayout';
                }else if($permission->status=="2"){
                  $this->layout = 'notApproveLayout';  
                }
            }
            $model = new Packages();
            $con = \Yii::$app->db;
            $api_key='rzp_test_QXEhrosnKHyZqA';
            $packages = $model->viewPackages($con);
            return $this->render('index', [
                                    'packages' => $packages,
                                    'apikey' => $api_key
                        ]);
    }

    /**
     * Displays a single Packages model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Packages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Packages();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Packages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
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
     * Deletes an existing Packages model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Packages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Packages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Packages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
