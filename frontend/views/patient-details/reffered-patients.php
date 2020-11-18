<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PatientDetailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reffered Patients';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-details-index">
    <div class="card-box mb-0">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'first_name',
            'last_name',
            'email:email',
            'phone',
            // 'profile_image:ntext',
            // 'address:ntext',
            // 'age',
            // 'gender',
            // 'state',
            // 'district',
            // 'city',
            // 'area',
            // 'status',
            
              [
                'label' => 'Reffered By',
                'value' => function($model){
                    $reffered=\common\models\PatientDetails::find()->where(['id'=>$model->refer_id])->one();
                    // print_r($reffered);exit;
                    return  $reffered->first_name.' '.$reffered->last_name;
                },
                // 'filter'=>ArrayHelper::map(Category::find()->asArray()->all(), 'id', 'category_name'),
                'filterInputOptions' => ['class' => 'form-control', 'id' => 'category'],
            ],

            // 'latitude',
            // 'longitude',
            // 'created_on',
            // 'otp',

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
</div>