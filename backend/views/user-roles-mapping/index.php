<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserRolesMappingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Roles Mappings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-roles-mapping-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'email:email',
            // 'id',
            // 'user_id',
            // ['attribute'=>'user_id',
            // 'label' => 'Admin',
            // 'value' => function($model){
            //      $data = common\models\AdminDetails::find()->where(['admin_id'=>$model->user_id])->one();
            //      return $data->name;
               
            // }
            // ],
            // 'role_id',
            // 'status',

            // ['class' => 'yii\grid\ActionColumn'],
            
            ['class' => 'yii\grid\ActionColumn',
                'header' => 'update',
                'template' => '{update}'],
        ],
    ]); ?>
</div>
