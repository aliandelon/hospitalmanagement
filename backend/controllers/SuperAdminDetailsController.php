<?php

namespace backend\controllers;

use Yii;
use common\models\AdminDetails;
use common\models\Login;
use common\models\AdminDetailsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * AdminDetailsController implements the CRUD actions for AdminDetails model.
 */
class SuperAdminDetailsController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all AdminDetails models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdminDetailsSearch();
        $dataProvider = $searchModel->search2(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AdminDetails model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    
    /**
     * Updates an existing AdminDetails model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
    {
        $model2 = Login::find()
                ->where(['type' => 1])
                ->one();

        $model = $this->findModel($model2->id);
        $encryptedPassword = $model2->password;     
        $model2->auth_key = '123';
        $model->password = Yii::$app->getSecurity()->validateData($encryptedPassword, $model2->auth_key);

        $images = $model->profile_image;
        if ($model->load(Yii::$app->request->post())) {
            $model2->email = $model->email;
            $model2->auth_key = '123';
            $model2->password = Yii::$app->getSecurity()->hashData($model->password, $model2->auth_key);
            $model2->type = 1;
            $model->role_id = 10;
             $file = UploadedFile::getInstance($model, 'profile_image');
            if($model2->save()){
            if ($file) {
                $model->profile_image = $file->extension;
            } else {
                $model->profile_image = $images;
            }
                if($model->save())
                {
                    $model->admin_id = $model2->id;
                    if($model->save())
                    {
                        if ($file) {
                            $model->upload($file, $model->id, $model->id);
                        }
                        return $this->redirect(['index']);
                    }
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AdminDetails model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AdminDetails model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdminDetails the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminDetails::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
