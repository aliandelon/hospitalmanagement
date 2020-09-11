<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\RolesMstSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Roles Masters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="roles-mst-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Roles', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            [   
                'attribute'=>'task',
                'filter'=>[1 => 'Category', 2 => 'Investigations',3=>'Banners',4=>'New Requests',5=>'Active Users'],
                'value'=>function($model){
                    if($model->task=="1"){return "Category";}
                    else if($model->task=="2"){ return "Investigations"; }    
                    else if($model->task=="3"){ return "Banners";}    
                    else if($model->task=="4"){ return "New Requests";}    
                    else if($model->task=="5"){ return "Active Users";}    
                }
            ],
            'sub_task',
            'sort_order',
             [   
                'attribute'=>'status',
                'format'=>'raw',//raw,
                'filter'=>['1'=>'Active','0'=>'In Active'],
                'filterInputOptions' => ['class' => 'form-control', 'id' => 'leave_status'],
                'value'=>function($model){
                    if($model->status=="1"){
                     return Html::a('<span class="label label-success">Active</span>');
                     }else{
                    return Html::a("<span class='label label-warning'>In Active</span>");
                     }    
                     
                }
            ],
                
                                ['class' => 'yii\grid\ActionColumn',
                                    'header' => 'Update',
                                    'template' => '{update}'],
                                // ['class' => 'yii\grid\ActionColumn',
                                //     'header' => 'Delete',
                                //     'template' => '{delete}'],
                                // ],
        ],
    ]); ?>
</div>
