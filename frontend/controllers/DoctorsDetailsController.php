<?php

namespace frontend\controllers;

use Yii;
use common\models\DoctorsDetails;
use common\models\DoctorsDetailsSearch;
use common\models\HolidayList;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DoctorsDetailsController implements the CRUD actions for DoctorsDetails model.
 */
class DoctorsDetailsController extends Controller
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
     * Lists all DoctorsDetails models.
     * @return mixed
     */
    public function actionLeaveList()
    {
        $model = new HolidayList();
        $con = \Yii::$app->db;
        $hospital_id = Yii::$app->user->identity->id;
        $doctors = $model->viewLeaveDoctors($con, $hospital_id);
        return $this->render('leavelist', [
            'doctorsList' => $doctors
        ]);
    }

    /**
     * Lists all DoctorsDetails models.
     * @return mixed
     */
    public function actionLeaveListAjax()
    {
        $post = Yii::$app->request->post();
        if($post){
            $dates = $post['dates'];
            $ftoDates=$this->correctDateFormat($dates);

        }

        $model = new HolidayList();
        $con = \Yii::$app->db;
        $hospital_id = Yii::$app->user->identity->id;
        $doctorsList = $model->viewLeaveDoctorsAjax($con, $hospital_id,$ftoDates['fromDate'],$ftoDates['toDate']);
        if(!empty($doctorsList)){
            $this->layout = FALSE;
            return $this->renderAjax('_doctorLeaveAjax',['doctorsList'=>$doctorsList]);
        }else{
            echo 2;
        }
        
    }

    protected function correctDateFormat($dates){
       $ftoArray=explode("-",$dates);
       $fdate=explode("/",trim($ftoArray[0]));
       $dateArray['fromDate']=$fdate[2].'-'.$fdate[0].'-'.$fdate[1];

       $tdate=explode("/",trim($ftoArray[1]));
       $dateArray['toDate']=$tdate[2].'-'.$tdate[0].'-'.$tdate[1];

        return $dateArray;
    }



    /**
     * Lists all DoctorsDetails models.
     * @return mixed
     */
    public function actionIndex()
    {
        
        $model = new DoctorsDetails();
        $con = \Yii::$app->db;
        $hospital_id = Yii::$app->user->identity->id;
        $doctors = $model->viewDoctors($con,$hospital_id);
        return $this->render('index', [
            'doctorsList' => $doctors
        ]);
    }

    /**
     * Displays a single DoctorsDetails model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = new DoctorsDetails();
        $con = \Yii::$app->db;
        $hospital_id = Yii::$app->user->identity->id;
        $doctors = $model->viewDoctors($con,$hospital_id,$id);
        return $this->render('view', [
            'doctorsList' => $doctors
        ]);
        // return $this->render('view', [
        //     'model' => $this->findModel($id),
        // ]);
    }

    /**
     * Creates a new DoctorsDetails model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DoctorsDetails();

        if ($model->load(Yii::$app->request->post()))
        {
            $model->hospital_clinic_id = Yii::$app->user->identity->id;
            $file = UploadedFile::getInstance($model, 'profile_image');
            if ($file) {
               $model->profile_image = $file->extension;     
            }
            if($model->save()) {
                if ($file) {
                $model->upload($file, $model->id, $model->id);
                }
            return $this->redirect(['index']);
            }
        }else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }

        
    }

    /**
     * Updates an existing DoctorsDetails model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'profile_image');
            if ($file) {
               $model->profile_image = $file->extension;     
            }
            if($model->save()) {
                if ($file) {
                $model->upload($file, $model->id, $model->id);
                }
            return $this->redirect(['index']);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing DoctorsDetails model.
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
     * Finds the DoctorsDetails model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DoctorsDetails the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DoctorsDetails::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
