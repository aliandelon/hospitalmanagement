<?php

namespace frontend\controllers;

use Yii;
use common\models\Schedule;
use common\models\ScheduleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\HospitalInvestigationMapping;

/**
 * ScheduleController implements the CRUD actions for Schedule model.
 */
class ScheduleController extends Controller
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
     * Lists all Schedule models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ScheduleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Schedule model.
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
     * Creates a new Schedule model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Schedule();
        $model2 = new HospitalInvestigationMapping();
        $con = \Yii::$app->db;
        $transaction = $con->beginTransaction();
        if ($model->load(Yii::$app->request->post())) {
            //$model->hospital_id = Yii::$app->user->identity->id;
            $model->hospital_id = 2;
            $model2->investigation_id = $model->investigation_id;
            $model2->hospital_clinic_id = $model->hospital_id;
            $model2->amount = $model->amount;
            $model2->duration = '30';
            $model2->details = '';
            $model2->status = 1;
            if($model->save()){
                $check = $model2->checkHospitalInvestigation($con, $model2);
                if($check)
                {
                    $delete = $model->deleteHospitalInvestigation($con, $model2);
                    if($model2->save()){
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }else{
                        $transaction->rollback();
                        return $this->render('create', [
                            'model' => $model,
                        ]);
                    }
                }else{
                    if($model2->save()){
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }else{
                        $transaction->rollback();
                        return $this->render('create', [
                            'model' => $model,'model2'=>$model2
                        ]);
                    }
                }
            }else{
                $transaction->rollback();
                return $this->render('create', [
                    'model' => $model,
                ]);   
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Schedule model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $con = \Yii::$app->db;
        $model = $this->findModel($id);
        $model2 = new HospitalInvestigationMapping();
        $model2->investigation_id = $model->investigation_id;
        $model2->hospital_clinic_id = $model->hospital_id;
        $model2->duration = '30';
        $model2->details = '';
        $model2->status = 1;
        $check = $model2->checkHospitalInvestigation($con, $model2);
        if($check)
        {
            $model->amount = $check['amount'];
            $model2->id = $check['id'];
        }
        if ($model->load(Yii::$app->request->post())) {
            $model2->amount = $model->amount;
            if($model->save()){
                $model2->updateHospitalInvestigation($con,$model2);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Schedule model.
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
     * Finds the Schedule model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Schedule the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Schedule::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
