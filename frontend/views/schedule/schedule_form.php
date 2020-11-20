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
.lds-roller {
  display: inline-block;
  position: relative;
  width: 80px;
  height: 80px;
}
.lds-roller div {
  animation: lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
  transform-origin: 40px 40px;
}
.lds-roller div:after {
  content: " ";
  display: block;
  position: absolute;
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #fff;
  margin: -4px 0 0 -4px;
}
.lds-roller div:nth-child(1) {
  animation-delay: -0.036s;
}
.lds-roller div:nth-child(1):after {
  top: 63px;
  left: 63px;
}
.lds-roller div:nth-child(2) {
  animation-delay: -0.072s;
}
.lds-roller div:nth-child(2):after {
  top: 68px;
  left: 56px;
}
.lds-roller div:nth-child(3) {
  animation-delay: -0.108s;
}
.lds-roller div:nth-child(3):after {
  top: 71px;
  left: 48px;
}
.lds-roller div:nth-child(4) {
  animation-delay: -0.144s;
}
.lds-roller div:nth-child(4):after {
  top: 72px;
  left: 40px;
}
.lds-roller div:nth-child(5) {
  animation-delay: -0.18s;
}
.lds-roller div:nth-child(5):after {
  top: 71px;
  left: 32px;
}
.lds-roller div:nth-child(6) {
  animation-delay: -0.216s;
}
.lds-roller div:nth-child(6):after {
  top: 68px;
  left: 24px;
}
.lds-roller div:nth-child(7) {
  animation-delay: -0.252s;
}
.lds-roller div:nth-child(7):after {
  top: 63px;
  left: 17px;
}
.lds-roller div:nth-child(8) {
  animation-delay: -0.288s;
}
.lds-roller div:nth-child(8):after {
  top: 56px;
  left: 12px;
}
@keyframes lds-roller {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
.loading {
  position: fixed;
  z-index: 1000;
  height: 2em;
  width: 2em;
  overflow: show;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}
.loading:before {
  content: '';
  display: block;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
    background: radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0, .8));

  background: -webkit-radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0,.8));
}
</style>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css"/>

<div class="loading" style="display:none;z-index: 111 !important;"><div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>
<?php $days = array(1=>"Monday",2=>"Tuesday",3=>"Wednesday",4=>"Thursday",5=>"Friday",6=>"Saturday",7=>"Sunday");?>
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
   <?php $invaccess=\common\models\HospitalClinicDetails::find()->where(['user_id'=>Yii::$app->user->identity->id])->one();
  
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
                    <?php foreach ($days as $key => $value) {?>
                    <div class="col-md-6">
                      <input type="hidden" name="<?=$value?>" value="<?=$value?>" id="day_<?=$key?>">&nbsp;<?=$value?>
                      <select class="form-control" id='docTimeslot_<?=$key?>' name="<?=$key?>timeSlots[]" multiple="multiple">
                          <option value="8:00 AM - 8:30 AM">8:00 AM - 8:30 AM</option>
                          <option value="8:30 AM - 9:00 AM">8:30 AM - 9:00 AM</option>
                          <option value="9:00 AM - 9:30 AM">9:00 AM - 9:30 AM</option>
                          <option value="9:30 AM - 10:00 AM">9:30 AM - 10:00 AM</option>
                          <option value="10:00 AM - 10:30 AM">10:00 AM - 10:30 AM</option>
                          <option value="10:30 AM - 11:00 AM">10:30 AM - 11:00 AM</option>
                          <option value="11:00 AM - 11:30 AM">11:00 AM - 11:30 AM</option>
                          <option value="11:30 AM - 12:00 PM">11:30 AM - 12:00 PM</option>
                          <option value="12:00 PM - 12:30 PM">12:00 PM - 12:30 PM</option>
                          <option value="12:30 PM - 01:00 PM">12:30 PM - 01:00 PM</option>
                          <option value="01:00 PM - 01:30 PM">01:00 PM - 01:30 PM</option>
                      </select>
                    </div>
                  <?php } ?>
                    <div class="col-md-12 text-center"><button type="button" class="btn btn-primary" id="docBtn"> Add Schedule</button></div>
            </div>
            <div  id="investigation" style="display: none;">
                <div class="row">
                    <div class="col-md-6" id="categoryList">
                        <?php 
                        // $details=Category::find()->where(["status"=>1])->orderBy(['sort_order' => SORT_ASC])->all();
                        $details=Category::find()->where(["status"=>1])->all();
                        $listData=ArrayHelper::map($details,'id','category_name');
                        echo $form->field($model, 'id')->dropDownList(
                            $listData,
                            [/*'multiple'=>'true',*/'size'=>'5','data-live-search'=>'true']
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
            days = [];
            $("#"+trId+" td select[name^='timeSlots']").each(function(){
              days.push($(this).val());
            });
            rate = $("#"+trId+" td input[name^='rate']").val();
            package = $("#"+trId+" td textarea[name^='package']").val();
        }else{
            days = "";
            rate = "";
            package="";
        }

        $.ajax({
             url:baseurl+'schedule/set-investigation-list',
             data:{'trId':trId,'checkbox':checkbox,'days':days,'rate':rate,'package':package},
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
          
           $('.loading').css('display','block');        
            $('#doctor').css('display','none');                
            $('#investigation').css('display','block');
            $('#investigationList').html('');
            $.ajax({
                 url:baseurl+'schedule/reset-session',
                 data:{'id':''},
                 type:'POST',
                 success:function(data){
                    console.log('');
                    $('.loading').css('display','none');    
                 },
                 error:function(){
                   $('.loading').css('display','none');    
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
         $('.loading').css('display','block');    
        $.ajax({
             url:baseurl+'schedule/get-investigation-list',
             data:{'category':selected},
             type:'POST',
             success:function(data){
                $('#investigationList').html(data);
                $('select').selectpicker();
                 $('.loading').css('display','none');    
             },
             error:function(){
                $('#investigationList').html('');
                $('.loading').css('display','none');    
             }
        });
    });


    $('#invBtn').click(function(){
      $('.loading').css('display','block');
         $.ajax({
             url:baseurl+'schedule/save-investigation',
             data:{},
             type:'POST',
             success:function(data){
              $('.loading').css('display','none');
                // $('#investigationList').html(data);
                // $('select').selectpicker();
             },
             error:function(){
               $('.loading').css('display','none');
                // $('#investigationList').html('');
             }
        });
      });




});

");
        ?>