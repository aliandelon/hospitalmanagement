<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\HospitalClinicDetailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'New Request Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hospital-clinic-details-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('New Request', ['new-request'], ['class' => 'btn btn-primary']) ?>
    </p>
    <?php if(Yii::$app->session->hasFlash('success')):?>
                    <div class="alert alert-success">
                      <?php echo Yii::$app->session->getFlash('success'); ?>
                    </div>
                    <!--<div class="info">-->
                        <!--Yii::$app->session->getFlash('myMessage');-->
                        
                    <!--</div>-->
                <?php endif; ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'user_id',
            'name',
           
            [   
                'attribute'=>'type',
                'format'=>'raw',//raw,
                'filter'=>['1'=>'Hospitals','2'=>'Clinics'],
                'filterInputOptions' => ['class' => 'form-control', 'id' => 'type'],
                'value'=>function($model){
                    if($model->type=="1"){
                     return Html::a('<span class="label label-success">Hospitals</span>');
                     }else{
                    return Html::a("<span class='label label-warning'>Clinics</span>");
                     }    
                     
                }
            ],
            'phone_number',
            'email:email',
            // 'have_diagnostic_center',
            // 'master_hospital_id',
            // 'same_as_hospital_details_flag',
            // 'address:ntext',
            // 'pincode',
            // 'street1',
            // 'street2',
            // 'city',
            // 'area',
            // 'latitude',
            // 'longitude',

            [   
                'attribute'=>'status',
                'format'=>'raw',//raw,
              
                'value'=>function($model){
                    if($model->status=="1"){
                     return Html::a('<span class="label label-success">Active</span>');
                     }  
                     
                }
            ],



          

            [
          'class' => 'yii\grid\ActionColumn',
          'header' => 'Actions',
          'headerOptions' => ['style' => 'color:#337ab7'],
          'template' => '{view}{update}',
          'buttons' => [
            'view' => function ($url, $model) {
               
                     return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',"view?id=".$model->id, ['newrequest-view','id'=>$model->id], [
                                'title' => Yii::t('app', 'lead-view'),
                    ]);   
                 
                
            },

            'update' => function ($url, $model) {
                if($model->status=='4'){
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['newrequest-update','id'=>$model->id], [
                                'title' => Yii::t('app', 'lead-update'),
                    ]);
                 }
            },

          ],
      ]




        ],
    ]); ?>
</div>
