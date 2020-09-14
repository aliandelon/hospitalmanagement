<?php

namespace backend\controllers;

use Yii;
use common\models\RolesMst;
use common\models\UserRolesMappingSearch;
use common\models\UserRolesMapping;
use common\models\AdminDetailsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserRolesMappingController implements the CRUD actions for UserRolesMapping model.
 */
class UserRolesMappingController extends Controller
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
     * Lists all UserRolesMapping models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdminDetailsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserRolesMapping model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        // return $this->render('view', [
        //     'model' => $this->findModel($id),
        // ]);
        return $this->redirect(['index']);
    }

    /**
     * Creates a new UserRolesMapping model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserRolesMapping();
        $tasks=RolesMst::find()->select('task')->distinct()->where(['status'=>1])->orderBy(['task' => SORT_ASC])->All();
        if($model->load(Yii::$app->request->post())){
            $count = 0;
            $userId = $model->user_id;
            $status = $model->status;
            foreach (Yii::$app->request->post('role_id') as $key => $value) {
                $model = new UserRolesMapping();
                $model->user_id = $userId;
                $model->status = $status;
                $model->role_id = $value;
                $model->save();
                $count++;
            }
            if ($count) {
                return $this->redirect(['index']);
            }
        } else {
                return $this->render('create', [
                    'model' => $model,'tasks'=>$tasks
                ]);
            }
    }

    /**
     * Updates an existing UserRolesMapping model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = new UserRolesMapping();
        $model->id = $id;
        $role = [];
        $tasks = [];
        $roles = [];
        $tasks=RolesMst::find()->select('task')->distinct()->where(['status'=>1])->orderBy(['task' => SORT_ASC])->All();
        foreach ($tasks as $key => $value) {
           // print_r($value['task']);
        }
        $role=UserRolesMapping::find()->select('role_id')->where(['user_id'=>$id])->andFilterWhere(['=', 'status', '1'])->All();
        foreach ($role as $key => $value) {
           $roles[] = $value['role_id'];
        }
        // print_r($roles);exit;
        if ($model->load(Yii::$app->request->post())) {
            UserRolesMapping::deleteAll('user_id = :user', [':user' => $id]);
            $count = 0;
            $userId = $model->user_id;
            $status = $model->status;
            $postData = Yii::$app->request->post('UserRolesMapping');
            if(isset($postData['role_id'])){
                foreach ($postData['role_id'] as $key => $value) {
                    $model = new UserRolesMapping();
                    $model->user_id = $userId;
                    $model->status = $status;
                    $model->role_id = $value;
                    $model->save();
                    $count++;
                }
                if ($count) {
                    return $this->redirect(['index']);
                }
            }else{
                    return $this->redirect(['index']);
            }
            
        } else {
            return $this->render('update', [
                'model' => $model,'tasks'=>$tasks,'roles'=>$roles,'id'=>$id
            ]);
        }
    }

    /**
     * Deletes an existing UserRolesMapping model.
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
     * Finds the UserRolesMapping model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserRolesMapping the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserRolesMapping::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
