<?php
use yii\helpers\Html;
//use kartik\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Category;
use yii\helpers\ArrayHelper;
use common\models\Investigations;
use common\models\DoctorsDetails;
// use kartik\select2\Select2;
?>
<style>
.field-schedule-amount{
    display: none;
}
</style>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css"/>



<div class="content">
    <div class="schedule-form">
    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger alert-dismissable">
             <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
             <h4><i class="icon fa fa-check"></i>Error!</h4>
             <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php endif; ?>
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->errorSummary($model) ?>
   <?php $invaccess=\common\models\HospitalClinicDetails::find()->where(['user_id'=>Yii::$app->user->identity->id])->one()
   ?>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group field-schedule-type has-success">
                <label class="control-label" for="type">Choose a Type:&nbsp;&nbsp;</label>
                <input type="radio" class="testDose" name="radio1" value="2" checked="true" onchange="$('#type').val($(this).val());"> Doctor AppointMent
                <?php if($invaccess->have_diagnostic_center=='1'){ ?>
                &nbsp;&nbsp;&nbsp;
                <input type="radio" class="testDose" name="radio1" value="1" onchange="$('#type').val($(this).val());"> Investigation
                <?php } ?>
                <input type="hidden" name="type" id="type">
                <!-- <select name="type" id="type" class="form-control">
                  <option value="2">Doctor Appoinment</option>
                 <?php //if($invaccess->have_diagnostic_center=='1'){ ?>
                  <option value="1">Investigation</option>
                    <?php //} ?>
                  
                </select> -->
            </div>
        </div>
        <div class="col-md-12">
            <div id="doctor" class="col-md-6" style="display: block">
                <?php $details=DoctorsDetails::find()->where(["status"=>1,"hospital_clinic_id"=>Yii::$app->user->identity->id])->all();

                $listData=ArrayHelper::map($details,'id','name');
                echo $form->field($model, 'doctor_id')->dropDownList(
                    $listData,
                    ['prompt'=>'Select Doctor','data-live-search'=>'true']
                    )->label('Doctor');
                    ?>
                    <select class="form-control" id='docDays' name="'.$value.'days[]" multiple data-live-search="true">
                        <option value="1">Monday</option>
                        <option value="2">Tuesday</option>
                        <option value="3">Wednesday</option>
                        <option value="4">Thursday</option>
                        <option value="5">Friday</option>
                        <option value="6">Saturday</option>
                        <option value="7">Sunday</option>
                    </select><br/><br/>
                    <select class="form-control" id='docTimeslot' name="'.$value.'timeSlots[]" multiple data-live-search="true">
                        <option value="8:00 AM - 8:30 AM">8:00 AM - 8:30 AM</option>
                        <option value="8:30 AM - 9:00 AM">8:30 AM - 9:00 AM</option>
                        <option value="9:00 AM - 9:30 AM">9:00 AM - 9:30 AM</option>
                        <option value="9:30 AM - 10:00 AM">9:30 AM - 10:00 AM</option>
                        <option value="10:00 AM - 10:30 AM">10:00 AM - 10:30 AM</option>
                        <option value="10:30 AM - 11:00 AM">10:30 AM - 11:00 AM</option>
                        <option value="11:00 AM - 11:30 AM">11:00 AM - 11:30 AM</option>
                        <option value="11:30 AM - 12:00 PM">11:30 AM - 12:00 PM</option>
                    </select><br/><br/>
                    <div class="col-md-12 text-center"><button type="button" class="btn btn-primary" id="docBtn"> Add Schedule</button></div>
            </div>
            <div  id="investigation" style="display: none;">
                <div class="row">
                    <div class="col-md-6" id="categoryList">
                        <?php $details=Category::find()->where(["status"=>1])->orderBy(['sort_order' => SORT_ASC])->all();
                        $listData=ArrayHelper::map($details,'id','category_name');
                        echo $form->field($model, 'id')->dropDownList(
                            $listData,
                            ['multiple'=>'true','size'=>'5','data-live-search'=>'true']
                            )->label('Investigation Category');
                            ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" id="investigationList"></div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center" style="padding-top: 25px"><button type="button" class="btn btn-primary" id="invBtn"> Add Schedule</button></div>
                </div>
            </div>
        </div>
    </div>
   <style>
       .pt20{
        padding-top: 35px;
       }
   </style> 
  

    <?php ActiveForm::end(); ?>



<script type="text/javascript">
    var defaultEvents;
    var baseurl = "<?php print \yii\helpers\Url::base() . "/"; ?>";
    var basepath = "<?php print \yii\helpers\Url::base(); ?>";
    var curl = "<?php print Yii::$app->request->absoluteUrl; ?>";

    function callSessionMaintain(trId){
        checkbox = ($("#"+trId+" td input[name^='investigations']").prop('checked') == true) ? "checked" : "";
        if(checkbox!=""){
            days = $("#"+trId+" td select[name^='days']").val();
            timeSlots = $("#"+trId+" td select[name^='timeSlots']").val();
            rate = $("#"+trId+" td input[name^='rate']").val();
            package = $("#"+trId+" td textarea[name^='package']").val();
        }else{
            days = "";
            timeSlots = "";
            rate = "";
            package="";
        }

        $.ajax({
             url:baseurl+'schedule/set-investigation-list',
             data:{'trId':trId,'checkbox':checkbox,'days':days,'timeSlots':timeSlots,'rate':rate,'package':package},
             type:'POST',
             success:function(data){
                console.log(data);
             },
             error:function(){
             }
        });

    }
    

</script>
<?php
$this->registerJs("
$(document).ready(function(){  
    $('select').selectpicker();  
    $('#schedule-id').selectpicker();   
    $('#docDays').selectpicker;
    $('#docTimeslot').selectpicker;   
    $('#schedule-investigation_id').selectpicker();
    $('#schedule-doctor_id').selectpicker();
    $('.testDose').on('change',function(e){
        var type = $('#type').val();
         $('.field-schedule-amount').css('display','none');
         $('.field-schedule-details').css('display','none');
        if(type == 1){
            $('#doctor').css('display','none');                
            $('#investigation').css('display','block');
            $('#investigationList').html('');
            $.ajax({
                 url:baseurl+'schedule/reset-session',
                 data:{'id':''},
                 type:'POST',
                 success:function(data){
                    console.log('');
                 },
                 error:function(){
                 }
            });
            $('#schedule-id option').removeAttr('selected');
            $('select').selectpicker();
        }else{
            $('#doctor').css('display','block');              
            $('#investigation').css('display','none');
            $('select').selectpicker();
            $('#investigationList').html('');
            $('#schedule-id').multiselect( 'refresh' );
            $('select').selectpicker();
        }

    });
    $('#schedule-id').on('change',function(e){
        var selected = $(this).val();
        $.ajax({
             url:baseurl+'schedule/get-investigation-list',
             data:{'category':selected},
             type:'POST',
             success:function(data){
                $('#investigationList').html(data);
                $('select').selectpicker();
             },
             error:function(){
                $('#investigationList').html('');
             }
        });
    });
});

");
        ?>