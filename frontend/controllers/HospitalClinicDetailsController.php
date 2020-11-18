<?php

namespace frontend\controllers;

use Yii;
use common\models\HospitalClinicDetails;
use common\models\HospitalClinicDetailsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * HospitalClinicDetailsController implements the CRUD actions for HospitalClinicDetails model.
 */
class HospitalClinicDetailsController extends Controller
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
     * Lists all HospitalClinicDetails models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HospitalClinicDetailsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single HospitalClinicDetails model.
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
     * Creates a new HospitalClinicDetails model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new HospitalClinicDetails();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing HospitalClinicDetails model.
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



 public function actionUpdate2($id)
    {
        $model = $this->findModel($id);
        $permission=HospitalClinicDetails::find()->where(['user_id'=>Yii::$app->user->identity->id])->one();
            if(!empty($permission)){
                if($permission->status=="4"){
                  $this->layout = 'notApproveLayout';
                 
                }else if($permission->status=="3"){
                  $this->layout = 'notApproveLayout';
                }else if($permission->status=="2"){
                  $this->layout = 'notApproveLayout';  
                }
                if($permission['id'] != $id)
                {
                   return $this->render('error-form', [
                        'model' => $model,
                    ]); 
                }
            }

        $model->scenario = 'updateFrontend';
        $images = $model->hospital_clinic_image;
        if ($model->load(Yii::$app->request->post())) {
            // echo '<pre>';
            // print_r(Yii::$app->request->post());exit;
            $file = UploadedFile::getInstance($model, 'hospital_clinic_image');
            $model->state=$_POST['HospitalClinicDetails']['state'];
            $model->latitude='0';
            $model->longitude='0';
            if($model->status==4){
               $model->status=3;
            }

            if($file!="") {
                
                   $model->hospital_clinic_image = $file->extension;     
                }else{
                
                    $model->hospital_clinic_image = $images;
                }
            if($model->save()){

                if ($file) {
                    $model->upload($file, $model->id, "hospitalClinicImage".$model->id);
                    }

              if(!empty($permission)){
                if($permission->status=="4"){
                return $this->redirect(Yii::$app->request->baseUrl.'/packages/index');
                }else if($permission->status=="3"){
                return $this->redirect(Yii::$app->request->baseUrl.'/packages/index');
                }else if($permission->status=="2"){
                  
                }else if($permission->status=="1"){
                Yii::$app->session->setFlash('success', 'Successfully updated the details');
                return $this->redirect('update2?id='.$id);  
                }
            }       


              
                }
                // else{print_r($model->getErrors());exit;}
            
        }
            return $this->render('update-form', [
                'model' => $model,
            ]);
       
    }






    /**
     * Deletes an existing HospitalClinicDetails model.
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
     * Finds the HospitalClinicDetails model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return HospitalClinicDetails the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = HospitalClinicDetails::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
