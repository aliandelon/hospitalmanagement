<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AppointmentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Appointment Cancellation Requests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appointments-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute'=>'patient_id',
                    'header' =>'Patient',
                    'value' => function($model){
                        $reffered=\common\models\PatientDetails::find()->where(['id'=>$model->patient_id])->one();
                        return  $reffered->first_name.' '.$reffered->last_name;
                    },
                ],
            [   
                'attribute'=>'doctor_id',
                'header' =>'Doctor',
                'value' => function($model){
                        $doctor=\common\models\DoctorsDetails::find()->where(['id'=>$model->doctor_id])->one();
                        if(!empty($doctor)){
                            return  $doctor->name;
                        }else{
                            return "";
                        }
                        
                    },
            ],
            
             [   
                'attribute'=>'hospital_clinic_id',
                'header' =>'Hospital',
                'value' => function($model){
                        $hospital=\common\models\HospitalClinicDetails::find()->where(['user_id'=>$model->hospital_clinic_id])->one();
                        return  $hospital->name;
                       
                        
                    },
            ],
            [   
                'attribute'=>'investigation_id',
                'header' =>'investigations',
                'value' => function($model){
                        $investigation=\common\models\Investigations::find()->where(['id'=>$model->investigation_id])->one();
                        if(!empty($investigation)){
                            return  $investigation->investigation_name;
                        }else{
                            return "";
                        }
                       
                       
                        
                    },
            ],
            
            [   
                'attribute'=>'app_date',
                'header' =>'Appointment Date',
                'value' => function($model) {
                    return date('d-m-Y',strtotime($model->app_date));
                },
            ],
            'app_time',
            // 'appointment_type',
            // 'isHomeCollection',
            'price',
            [
            'class' => 'yii\grid\ActionColumn',
             'header' =>'Cancel Request',
            'template' => '{delete}',
            'buttons' => [
                'delete' => function ($url,$model) {
                    return Html::a(

                        '<button type="button" val="'.$model->id.'" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Cancel Request</button>', 
                        'javascript:void(0)');
                },
                // 'link' => function ($url,$model,$key) {
                //     return Html::a('Action', $url);
                // },
            ],
        ],
         [
            'class' => 'yii\grid\ActionColumn',
            'header' =>'Approve Request',
            'template' => '{delete}',
            'buttons' => [
                'delete' => function ($url,$model) {
                    return Html::a(
                        '<button type="button" val="'.$model->id.'" id="approve-refund" class="btn btn-success">Approve Request</button>', 
                        'javascript:void(0)');
                },
                // 'link' => function ($url,$model,$key) {
                //     return Html::a('Action', $url);
                // },
            ],
        ],
            // ['class' => 'yii\grid\ActionColumn'],

        ],
    ]); ?>
</div>
<!-- Trigger the modal with a button -->


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cancel Repayment</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" id="appid" >
        <p>Reason for rejection.</p>
        <textarea id="r-reason" rows="5" style="width:100%"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" id="savecancel" class="btn btn-success" >Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<?php
$this->registerJs("
        $(document).ready(function(){  
            $('.btn-danger').click(function(e){
                var id=$(this).attr('val');
                $('#appid').val(id);
            });

            $('#savecancel').click(function(e){
                var appid=$('#appid').val();
                var reason=$('#r-reason').val();
                if(reason==''){
                     swal('','Sorry please enter the reason for rejection!', {
                                          icon: 'error',
                                        }); 
                    }else{
                swal({
                  title: 'Are you sure?',
                  text: 'you are going to cancell the request from the customer!',
                  icon: 'warning',
                  buttons: true,
                  dangerMode: true,
                })
                .then((willDelete) => {
                  if (willDelete) {

                     $.ajax({
                             url:baseurl+'appointments/cancel-repayment',
                             data:{'appid':appid,'reason':reason},
                             type:'POST',
                             success:function(data){
                                     if(data.response==200){
                                         swal('','Successfully Cancelled the refund request. Cancelled refund request can view in cancelled refund section!', {
                                          icon: 'success',
                                        }
                                        );
                                        setInterval(function(){
                                           window.location.href = '';
                                           },3000);
                                         // window.location.href = '';
                                    }else if(data.response==300){
                                         swal('','Appointment not found!', {
                                          icon: 'error',
                                        });
                                    }else if(data.response==400){
                                         swal('','Sorry something went wrong!', {
                                          icon: 'error',
                                        }); 
                                    }
                               
                                
                             },
                             error:function(){
                              swal('','Sorry something went wrong try again!', {
                                          icon: 'error',
                                        }); 
                             }


                        });




                   
                  } 
                });


}





            });
            
            
            
            $('#approve-refund').click(function(e){
              var appid=$(this).attr('val');  
              
               swal({
                  title: 'Are you sure?',
                  text: 'you are going to approve the request from the patient!',
                  icon: 'warning',
                  buttons: true,
                  dangerMode: true,
                })
                .then((willDelete) => {
                  if (willDelete) {

                     $.ajax({
                             url:baseurl+'appointments/approve-repayment',
                             data:{'appid':appid},
                             type:'POST',
                             success:function(data){
                                     if(data.response==200){
                                         swal('','Refund request placed succesfully!', {
                                          icon: 'success',
                                        }
                                        );
                                        setInterval(function(){
                                          window.location.href = '';
                                          },3000);
                                         // window.location.href = '';
                                    }else if(data.response==300){
                                         swal('','Appointment not found!', {
                                          icon: 'error',
                                        });
                                    }else if(data.response==400){
                                         swal('','Sorry something went wrong!', {
                                          icon: 'error',
                                        }); 
                                    }
                               
                                
                             },
                             error:function(){
                                swal('','Sorry something went wrong try again!', {
                                          icon: 'error',
                                        }); 
                             
                             }


                        });




                   
                  } 
                });
              
              
            });
            
          //End  
            
            
            
            
            
            
        });
");
?>