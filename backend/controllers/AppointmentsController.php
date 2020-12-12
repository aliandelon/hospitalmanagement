<?php

namespace backend\controllers;

use Yii;
use common\models\Appointments;
use common\models\AppointmentsSearch;
use common\models\PaymentVerification;
use common\models\Refund;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AppointmentsController implements the CRUD actions for Appointments model.
 */
class AppointmentsController extends Controller
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
     * Lists all Appointments models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AppointmentsSearch();
        $dataProvider = $searchModel->searchCancelation(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Appointments model.
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
     * Creates a new Appointments model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Appointments();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Appointments model.
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
     * Deletes an existing Appointments model.
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
     * Finds the Appointments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Appointments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Appointments::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionCancelRepayment(){
        $this->layout = FALSE;
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $post = Yii::$app->request->post();
        $appid = $post['appid'];
        $appointments=Appointments::find()->where(['id'=>$appid])->one(); 
        if(!empty($appointments)){
         $paymentVerification=PaymentVerification::find()->where(['booking_id'=>$appointments->booking_id])->one();
         if(!empty($paymentVerification)){
           $model=new Refund();
            // $model->razorpay_refund_id="";
            $model->razorpay_payment_id=$paymentVerification->razorpay_payment_id;
            $model->razorpay_order_id=$paymentVerification->razorpay_order_id;
            $model->booking_id=$paymentVerification->booking_id;
            $model->patient_id=$appointments->patient_id;
            $model->doctor_id=$appointments->doctor_id;
            $model->investigation_id=$appointments->investigation_id;
            $model->hospital_clinic_id=$appointments->hospital_clinic_id;
            $model->app_date=$appointments->app_date;
            $model->app_time=$appointments->app_time;
            $model->price=$appointments->price;
            $model->status=1;
            if($model->save()){
                return ['response' => 200,'message'=>'Successfully Rejected'];
            }else{
                return ['response' => 400,'message'=>'Sorry something went wrong'];
            }
         }else{
            return ['response' => 400,'message'=>'Sorry something went wrong'];
         }
        }else{
            return ['response' => 300,'message'=>'Appointment not found'];    
        }
        
    }





}
