<?php

namespace backend\controllers;

use Yii;
use common\models\HospitalClinicDetails;
use common\models\HospitalClinicDetailsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Login;

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

    public function actionNewRequestIndex()
    {
        $searchModel = new HospitalClinicDetailsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('new-request-index', [
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

    public function actionNewrequestView($id)
    {
        return $this->render('newrequest_view', [
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

        if ($model->load(Yii::$app->request->post())) {
            print_r($model->attributes);exit;
            if($model->save())
            {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionNewRequest()
    {
        $model = new HospitalClinicDetails();
        $model2 = new Login();
        $model->scenario = 'newrequest';
        if ($model->load(Yii::$app->request->post())) {
            $model2->email = $model->email;
            $model2->auth_key = '123';
            $model2->password = Yii::$app->getSecurity()->hashData($model->password, $model2->auth_key);
            $model2->type = 3;
            if($model2->save()){
                $model->user_id = $model2->id;
                $model->status = 4;
                $model->created_by = Yii::$app->user->identity->id;
                if($model->save())
                {
                    return $this->redirect(['newrequest-view', 'id' => $model->id]);
                }else{
                    print_r($model->getErrors()); exit;

                }
            }
        } else {
            return $this->render('new-request-create', [
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

    public function actionNewrequestUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'newrequest';
        $model2 = Login::findOne($model->user_id);
        $encryptedPassword = $model2->password;
        $model->password = Yii::$app->getSecurity()->validateData($encryptedPassword, $model2->auth_key);
        if ($model->load(Yii::$app->request->post())) {
            $model2->email = $model->email;
            $model2->auth_key = '123';
            $model2->password = Yii::$app->getSecurity()->hashData($model->password, $model2->auth_key);
            if($model2->save()){
                if($model->save())
                {
                    return $this->redirect(['newrequest-view', 'id' => $model->id]);
                }
            }
        } else {
            return $this->render('newrequest-update', [
                'model' => $model,
            ]);
        }
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

    public function actionDetailsEnteredView($id)
    {
        return $this->render('details-entered-view', [
            'model' => $this->findModel($id),
        ]);
    }
 public function actionApproveDetails($id)
    {
        $model = HospitalClinicDetails::find()->where(['id' => $id])->one();
        // echo '<pre>';
        // print_r($model);exit;
        $model->status=1;
        $model->save(false);
        Yii::$app->session->setFlash('success', 'The hospital '.$model->name.' has been succesfully verified and approved');
        return $this->redirect(['new-request-index']);
    }
public function actionRejectDetails($id)
    {
        $model = HospitalClinicDetails::find()->where(['id' => $id])->one();
        $model->status=2;
        $model->save(false);
        Yii::$app->session->setFlash('success', 'The hospital '.$model->name.' Rejected');
        return $this->redirect(['new-request-index']);
    }
}
