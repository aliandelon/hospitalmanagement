<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Investigations;
use common\models\DoctorsDetails;
use common\models\Category;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ScheduleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Schedules';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php /*$this->registerCssFile("@web/css/themes/black-and-white.css", [
    'depends' => [\yii\bootstrap\BootstrapAsset::className()],
    'media' => 'print',
], 'css-print-theme');*/
?>
<div class="schedule-index">
    <div class="row">
        <div class="col-sm-4 col-3">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-sm-8 col-9 text-right m-b-20">
            <?= Html::a('Create Schedule', ['create'], ['class' => 'btn btn-primary btn-rounded float-right']) ?>
        </div>
    </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
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
                            'attribute' => 'category',
                            'label' => 'Investigation Catgory',
                            'value' => function($model){
                                return $model->investigations->category->category_name;
                            },
                            'filter'=>ArrayHelper::map(Category::find()->asArray()->all(), 'id', 'category_name'),
                            'filterInputOptions' => ['class' => 'form-control', 'id' => 'category'],
                            'format'=>'raw',
                        ],
                        /*[
                            'attribute'=>'hospital_id',
                            'label' => 'Hospital',
                            'value' => function($model){
                                return $model->hospital->name;
                            },
                            'filter'=>ArrayHelper::map(DoctorsDetails::find()->where('status = 1 AND  hospital_clinic_id = 2')->all(), 'id','name'),
                            'filterInputOptions' => ['class' => 'form-control', 'id' => 'category'],
                        ],*/
                        [
                            'attribute'=>'doctor_id',
                            'label' => 'Doctor',
                            'value' => function($model){
                                if($model->doctor_id)
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

                        // ['class' => 'yii\grid\ActionColumn',
                        //     'header' => 'update',
                        //     'template' => '{update}'],
                        // ['class' => 'yii\grid\ActionColumn',
                        //     'header' => 'view',
                        //     'template' => '{view}',
                        // ],
                        [
                          'class' => 'yii\grid\ActionColumn',
                          'header' => 'Actions',
                          'headerOptions' => ['style' => 'color:#337ab7'],
                          'template' => '{view}',
                          'buttons' => [
                            'view' => function ($url, $model) {
                               
                                     return Html::a('View',"view?id=".$model->id, ['newrequest-view','id'=>$model->id], [
                                                'title' => Yii::t('app', 'lead-view'),
                                    ]);   
                                 
                                
                            },

                          ],
                      ],
                      [
                          'class' => 'yii\grid\ActionColumn',
                          'header' => 'Actions',
                          'headerOptions' => ['style' => 'color:#337ab7'],
                          'template' => '{update}',
                          'buttons' => [
                          'update' => function ($url, $model) {
                                return Html::a('Update', ['create','investigation'=>$model->investigation_id], [
                                            'title' => Yii::t('app', 'lead-update'),
                                ]);
                            },
                        ],
                      ]
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
