<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Investigations;
use common\models\DoctorsDetails;
use common\models\Category;
use common\models\Schedule;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ScheduleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Schedules';
$this->params['breadcrumbs'][] = $this->title;
?>
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"/>
<style>
.button {
  display: inline-block;
    border-radius: 4px;
    background-color: #05ab9e;
    border: none;
    height: 0px;
    color: #FFFFFF;
    text-align: center;
    font-size: 11px;
    /* padding-top: 5px; */
    padding: 20px;
    padding-top: 3px;
    width: 102px;
    transition: all 0.5s;
    cursor: pointer;
    /* margin: -1px;
}
</style>
  <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Large Modal</button> -->
<!-- Modal -->






<div class="schedule-index">
    <div class="row">
        <div class="col-sm-4 col-3">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-sm-8 col-9 text-right m-b-20">
            <?= Html::a('Create Schedule', ['create'], ['class' => 'btn btn-primary btn-rounded float-right']) ?>
        </div>
    </div>
    <?php 
    $doctorsList = Schedule::find()->select('doctor_id')->distinct()->andWhere(['<>','doctor_id',''])->andWhere(['=','hospital_id',Yii::$app->user->identity->id])->all();
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
               <div class="card-box">
                   <div class="form-group row">
                        <label class="col-form-label col-md-1">Schedules For</label>
                            <div class="col-md-4">
                                <select class="form-control">
                                    <option>Doctor</option>
                                    <option>Investigation</option>
                                    
                                </select>
                            </div>
                            <?php
                            if(!empty($doctorsList)){
                             ?>
                            <div class="col-md-4">
                                <select class="form-control">
                                    <?php
                                    foreach($doctorsList as $docList){
    $doctors = DoctorsDetails::find()->where(['id'=>$docList->doctor_id])->one();                             
                                    ?>
                                    <option value="<?=$doctors->id?>"><?=$doctors->name?></option>
                                   
                                     <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <?php
                            }else{
                            ?>
                             <div class="col-md-4">
                                <select class="form-control">
                                    <option>investigati1</option>
                                    <option>investigati2</option>
                                    
                                </select>
                            </div>
                            <?php
                            }
                            ?>
                    </div> 
 <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'investigation_id',
            // 'hospital_clinic_id',
            // 'doctor_id',
            'day',
    ['class' => 'yii\grid\ActionColumn', 
    'template' => '{new_action1}',
     'header' => 'View slots', 
     'headerOptions' => ['style' => 'color:#3181d2'],
     'buttons' => ['new_action1' => function ($url, $model) {
        return Html::button('View slots', ['class' => 'button view-slot','slotId'=>$model->id]);
     }],
    ],

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
        ],
    ]); ?>
<!-- <div id="add_schedule_event" class="modal" role="dialog"> -->
           <div class="modal" id="myModal" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Sloat Timings</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        
          
            <div class="modal-body">
                <div class="container" style="max-width: 100%">
              <div class="row" id="slot-time-view" >
               
              </div>
              
            <!-- </div> -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

               </div>
            </div>
        </div>
    </div>
</div>
<script>
    var baseurl = '<?php print \yii\helpers\Url::base() . "/"; ?>';
  </script>
<?php
$this->registerJs("
    $(document).ready(function(){
        $('.view-slot').on('click',function(e){
            var slotid=$(this).attr('slotid');
           $.ajax({
                     url:baseurl+'schedule/view-time',
                     data:{'slotid':slotid},
                     type:'POST',
                     success:function(data){
                       
                        $('#slot-time-view').html('');
                        $('#slot-time-view').append(data);
                     },
                     error:function(){
                     }
                });
        $('#myModal').modal('toggle');
        });
    });

");
        ?>