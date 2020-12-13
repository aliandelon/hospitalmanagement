<?php

namespace frontend\controllers;

use Yii;
use common\models\Packages;
use common\models\PackagesSearch;
use common\models\PackagePayment;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\HospitalClinicDetails;
use Razorpay\Api\Api;
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


    public function actionRazorpay()
    {
        $model = new PackagePayment();
        // echo 'reach';exit;
        $api = new Api('rzp_test_bTrHANOgDU4a8o','kIgswUqnhz1iGTA38M5hiZSN');
        $post = Yii::$app->request->post();
        $id = $post['payId'];

        // Payments
        // $payments = $api->payment->all($options); // Returns array of payment objects
        $payment  = $api->payment->fetch($id); // Returns a particular payment

            $model->payment_id = $payment['id'];
            $model->entity = $payment['entity'];
            $model->amount = $payment['amount']/100;
            $model->currency = $payment['currency'];
            $model->status = $payment['status'];
            $model->order_id = $payment['order_id'];
            $model->invoice_id = $payment['invoice_id'];
            $model->method = $payment['method'];
            $model->amount_refunded = $payment['amount_refunded'];
            $model->refund_status = $payment['refund_status'];
            $model->description = $payment['description'];
            $model->card_id = $payment['card_id'];
            $model->bank = $payment['bank'];
            $model->wallet = $payment['wallet'];
            $model->email = $payment['email'];
            $model->contact = $payment['contact'];
            $model->fee = $payment['fee']/100;
            $model->tax = $payment['tax']/100;
            $model->expiry_date = date('Y-m-d');
            if($model->save()){
                return  json_encode($payment);
            }else{
                return false;
            }

        // $payment  = $api->payment->fetch($id)->capture(array('amount'=>'50000')); // Captures a payment

        // To get the payment details
        // echo $payment->amount;
        // echo $payment->currency;
    }

}
