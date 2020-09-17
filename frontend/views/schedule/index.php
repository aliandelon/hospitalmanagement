<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Investigations;
use common\models\DoctorsDetails;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ScheduleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Schedules';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="schedule-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Schedule', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'investigation_id',
                'label' => 'Investigation',
                'value' => function($model){
                    return $model->investigations->investigation_name;
                },
                'filter'=>ArrayHelper::map(Investigations::find()->where('status = 1')->all(), 'id','investigation_name'),
                'filterInputOptions' => ['class' => 'form-control', 'id' => 'category'],
            ],
            [
                'attribute'=>'hospital_id',
                'label' => 'Hospital',
                'value' => function($model){
                    return $model->hospital->name;
                },
                'filter'=>ArrayHelper::map(DoctorsDetails::find()->where('status = 1 AND  hospital_clinic_id = 2')->all(), 'id','name'),
                'filterInputOptions' => ['class' => 'form-control', 'id' => 'category'],
            ],
            [
                'attribute'=>'doctor_id',
                'label' => 'Doctor',
                'value' => function($model){
                    return $model->doctor->name;
                },
                'filter'=>ArrayHelper::map(Investigations::find()->where('status = 1')->all(), 'id','investigation_name'),
                'filterInputOptions' => ['class' => 'form-control', 'id' => 'category'],
            ],
            [   
                'attribute'=>'sunday_holiday',
                'format'=>'raw',//raw,
                'filter'=>['1'=>'Yes','0'=>'No'],
                'filterInputOptions' => ['class' => 'form-control', 'id' => 'leave_status'],
                'value'=>function($model){
                    if($model->status=="1"){
                     return Html::a('<span class="label label-success">Yes</span>');
                     }else{
                    return Html::a("<span class='label label-warning'>No</span>");
                     }    
                     
                }
            ],
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
            // 'created_on',

            ['class' => 'yii\grid\ActionColumn',
                    'header' => 'update',
                    'template' => '{update}'],
            ['class' => 'yii\grid\ActionColumn',
                'header' => 'view',
                'template' => '{view}',
            ],
        ],
    ]); ?>
</div>
