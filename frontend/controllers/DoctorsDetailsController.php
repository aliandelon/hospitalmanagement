<?php

namespace frontend\controllers;

use Yii;
use common\models\DoctorsDetails;
use common\models\DoctorsDetailsSearch;
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
    public function actionIndex()
    {
        // $searchModel = new DoctorsDetailsSearch();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        // return $this->render('index', [
        //     'searchModel' => $searchModel,
        //     'dataProvider' => $dataProvider,
        // ]);
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

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id]);
        // } else {
        //     return $this->render('create', [
        //         'model' => $model,
        //     ]);
        // }
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
