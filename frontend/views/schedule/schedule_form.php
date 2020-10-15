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
   
    <div class="row">
        <div class="col-md-6">
            <div class="form-group field-schedule-type has-success">
                <label class="control-label" for="type">Choose a Type:</label>
                <select name="type" id="type" class="form-control">
                  <option value="2">Doctor Appoinment</option>
                  <option value="1">Investigation</option>
                  
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div id="doctor">
                <?php $details=DoctorsDetails::find()->where(["status"=>1,"hospital_clinic_id"=>Yii::$app->user->identity->id])->all();

                $listData=ArrayHelper::map($details,'id','name');
                echo $form->field($model, 'doctor_id')->dropDownList(
                    $listData,
                    ['prompt'=>'Select Doctor...','data-live-search'=>'true']
                    )->label('Doctor');
                    ?>
            </div>
            <div  id="investigation" style="display: none;">
            <?php 
                $Investigations = Investigations::find()->where('status = 1')->all();
                $listData=ArrayHelper::map($Investigations,'id','investigation_name');
                // echo $form->field($model, 'investigation_id')->widget(Select2::classname(), [
                //     'data' => $listData,
                //     'options' => ['placeholder' => 'Select  ...'],
                //     'pluginOptions' => [
                //         'tags' => true
                //     ],
                // ]); 
                echo $form->field($model, 'investigation_id')->dropDownList(
                    $listData,
                    ['prompt'=>'Select Investigation...','data-live-search'=>'true']
                    )->label('Investigation');
            ?>
        </div>
        </div>
    </div>
    <div class="row">
        
        <div class="col-md-6" id="amount" style="display: none">
            <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>
            <span id="amounterror" style="color: red;display: none;">Please enter amount</span>
        </div>
         <div class="col-md-6" id="">
            <div class="form-check form-check-inline" id="sample-collection" style="padding-top: 30px;width:100%;display: none">
                <!-- <input type="checkbox" id="schedule-ishomecollection" name="Schedule[isHomeCollection]" value="1"> -->
    <?= $form->field($model, "isHomeCollection")->checkbox(['label' => "
Sample collection available"])->label(false); ?>
                
              <!-- <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1"> -->
             
            </div>
        </div>
    </div>
  

    <?php ActiveForm::end(); ?>

</div>
    <div class="row">
        <div class="col-sm-8 col-4">
<!--             <h4 class="page-title">Calendar</h4>
 -->        </div>
        <div class="col-sm-4 col-8 text-right m-b-30">
            <a href="#" id ="add_schedule_button" class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#add_schedule_event" style="display: none;"><i class="fa fa-plus"></i> Add Schedule</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box mb-0">
                <div class="row">
                    <div class="col-md-12">
                        <div id="schedule_calendar"></div>
                    </div>
                </div>
            </div>
            <div id="schedule-modal" class="modal fade" role="dialog" style="overflow: inherit;">
                <div class="modal-dialog">
                    <div class="modal-content modal-lg">
                        <div class="modal-header">
                            <h4 class="modal-title">Delete Schedule</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body" style="height: 95px;">
                            
                        </div>
                    </div>
                </div>
            </div>
            <div id="add_schedule_event" class="modal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content modal-lg">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Schedule</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <!-- <form> -->
                                <div class="form-group">
                                    <label>From Date <span class="text-danger">*</span></label>
                                    <div class="cal-icon">
                                        <input class="form-control datetimepicker" type="text" id="eventDate">
                                    </div>
                                    <span id="dateerror" style="color: red;display: none;">Please Select From Date</span>

                                </div>
                                <div class="form-group">
                                    <label>To Date <span class="text-danger">*</span></label>
                                    <div class="cal-icon">
                                        <input class="form-control datetimepicker" type="text" id="eventDate2">
                                    </div>
                                    <span id="dateerror2" style="color: red;display: none;">Please Select To Date</span>

                                </div>
                                <div class="form-group">
                                    <label>Slots <span class="text-danger">*</span></label>
                                    <!-- <input class="form-control" type="text" id="eventName"> -->
                                    <select name="slot[]" id="slot" multiple="multiple" class="form-control">
                                      <option value="">Select</option>
                                      <option value="7.30-8.00">7.30 AM - 8.00 AM</option>
                                      <option value="8.00-8.30">8.00 AM - 8.30 AM</option>
                                      <option value="8.30-9.00">8.30 AM - 9.00 AM</option>
                                      <option value="9.00-9.30">9.00 AM - 9.30 AM</option>
                                      <option value="9.30-10.00">9.30 AM - 10.00 AM</option>
                                      <option value="10.00-10.30">10.00 AM - 10.30 AM</option>
                                      <option value="10.30-11.00">10.30 AM - 11.00 AM</option>
                                      <option value="11.00-11.30">11.00 AM - 11.30 AM</option>
                                      <option value="11.30-12.00">11.30 AM - 12.00 AM</option>
                                      <option value="12.00-12.30">12.00 PM - 12.30 PM</option>
                                      <option value="12.30-13.00">12.30 PM - 01.00 PM</option>
                                      <option value="13.00-13.30">01.00 PM - 01.30 PM</option>
                                      <option value="13.30-14.00">01.30 PM - 02.00 PM</option>
                                      <option value="14.00-14.30">02.00 PM - 02.30 PM</option>
                                      <option value="14.30-15.00">02.30 PM - 03.00 PM</option>
                                      <option value="15.00-15.30">03.00 PM - 03.30 PM</option>
                                      <option value="15.30-16.00">03.30 PM - 04.00 PM</option>
                                      <option value="16.00-16.30">04.00 PM - 04.30 PM</option>
                                      <option value="16.30-17.00">04.30 PM - 05.00 PM</option>
                                      <option value="17.00-17.30">05.00 PM - 05.30 PM</option>
                                      <option value="17.30-18.00">05.30 PM - 06.00 PM</option>
                                      <option value="18.00-18.30">06.00 PM - 06.30 PM</option>
                                      <option value="18.30-19.00">06.30 PM - 07.00 PM</option>
                                      <option value="19.00-19.30">07.00 PM - 07.30 PM</option>
                                    </select>
                                    <span id="sloteerror" style="color: red;display: none;">Please Select One Slot</span>
                                </div>
                                <div class="m-t-20 text-center">
                                    <span id="commonerror" style="color: red;display: none;"></span>
                                    <button class="btn btn-primary submit-btn">Create Schedule</button>
                                </div>
                            <!-- </form> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
/*.fc-time{
    display:none;
}*/
#add_schedule_event{
    opacity: 1;
}
#schedule-modal {
    opacity: 1;
    margin-top: 15%;
}
</style>

<script type="text/javascript">
    var defaultEvents;
    var baseurl = "<?php print \yii\helpers\Url::base() . "/"; ?>";
    var basepath = "<?php print \yii\helpers\Url::base(); ?>";
    var curl = "<?php print Yii::$app->request->absoluteUrl; ?>";

</script>
<?php
$this->registerJs("
$(document).ready(function(){          
        $('#schedule-investigation_id').selectpicker();
        $('#schedule-doctor_id').selectpicker();
        //$('#slot').multiselect();
        $('#eventDate').datetimepicker().on('dp.show', function () {
                return $(this).data('DateTimePicker').minDate(new Date());
        });
        $('#eventDate2').datetimepicker().on('dp.show', function () {
                return $(this).data('DateTimePicker').minDate(new Date());
        });
        $('#type').on('change',function(e){
            var type = $('#type').val();
            if(type == 1){
                


                $('#sample-collection').css('display','block');
                $('#doctor').css('display','none');
                $('#amount').css('display','block');
                $('#investigation').css('display','block');
            }else{
                $('#sample-collection').css('display','none');
                $('#doctor').css('display','block');
                $('#amount').css('display','none');
                $('#investigation').css('display','none');
            }

        });
        $('.submit-btn').on('click',function(e){
            var type = $('#type').val();
            if(type == 1){
                e.preventDefault();
                var eventDate = $('#eventDate').val();
                var eventDate2 = $('#eventDate2').val();
                if(eventDate == '')
                {
                    $('#dateerror').css('display','block');
                    return false;
                }else{
                    $('#dateerror').css('display','none');
                }
                if(eventDate2 == '')
                {
                    $('#dateerror2').css('display','block');
                    return false;
                }else{
                    $('#dateerror2').css('display','none');
                }
                var amount = $('#schedule-amount').val();
                var ishomecollection=$('#schedule-ishomecollection').val();
                var investigation = $('#schedule-investigation_id').val();
                var slots = $('#slot').val(); 
                if(slots == '' || slots == null){
                    $('#sloteerror').css('display','block');
                    return false;
                }else{
                    $('#sloteerror').css('display','none');
                }
                var d1 = eventDate.split('/').reverse().join('-');
                var d2 = eventDate2.split('/').reverse().join('-');
                diffDays = date_diff_indays(d2, d1);
                if(d1 > d2)
                {
                  $('#commonerror').css('display','block');
                  document.getElementById('commonerror').innerHTML = 'To Date should be greater than or equals to from Date';
                  return false;
                }else{
                    $('#commonerror').css('display','none');
                }
                var newdate = eventDate.split('/').reverse().join('-');
                var newdate1 = eventDate2.split('/').reverse().join('-');
                days = date_diff_indays(newdate, newdate1);
                if(days > 7)
                {
                    document.getElementById('commonerror').innerHTML = 'From To Date Difference should not greater than 7 days';
                    $('#commonerror').css('display','block');
                    return false;
                }else{
                    $('#commonerror').css('display','none');
                }           
                if(amount == '')
                {
                    $('#add_schedule_event').modal('hide')
                    $('#amounterror').css('display','block');
                    return false;
                }else
                {
                    $('#amounterror').css('display','none');
                }
                // alert(ishomecollection);
                $.ajax({
                     url:baseurl+'schedule/schedule',
                     data:{'eDate':eventDate,'eDate2':eventDate2,'slots':slots,'investigation':investigation,'amount':amount,'ishomecollection':ishomecollection},
                     type:'POST',
                     success:function(data){
                        // $('#accordion').html(data);
                        // alert(data);
                        window.location.href = '';
                     },
                     error:function(){
                     }
                });
            }else{
                e.preventDefault();
                var eventDate = $('#eventDate').val();
                var eventDate2 = $('#eventDate2').val();
                if(eventDate2 == '')
                {
                    $('#dateerror2').css('display','block');
                    return false;
                }else{
                    $('#dateerror2').css('display','none');
                }
                if(eventDate == '')
                {
                    $('#dateerror').css('display','block');
                    return false;
                }else{
                    $('#dateerror').css('display','none');
                }
                var doctor = $('#schedule-doctor_id').val();
                var slots = $('#slot').val(); 
                if(slots == '' || slots == null){
                    $('#sloteerror').css('display','block');
                    return false;
                }else{
                    $('#sloteerror').css('display','none');
                }
                var d1 = eventDate.split('/').reverse().join('-');
                var d2 = eventDate2.split('/').reverse().join('-');
                diffDays = date_diff_indays(d2, d1);
                if(d1 > d2)
                {
                  $('#commonerror').css('display','block');
                  document.getElementById('commonerror').innerHTML = 'To Date should be greater than or equals to from Date';
                  return false;
                }else{
                    $('#commonerror').css('display','none');
                }
                var newdate = eventDate.split('/').reverse().join('-');
                var newdate1 = eventDate2.split('/').reverse().join('-');
                days = date_diff_indays(newdate, newdate1);
                if(days > 7)
                {
                    document.getElementById('commonerror').innerHTML = 'From To Date Difference Should not greater than 7 days';
                    $('#commonerror').css('display','block');
                    return false;
                }else{
                    $('#commonerror').css('display','none');
                } 
                $.ajax({
                     url:baseurl+'schedule/doctor-schedule',
                     data:{'eDate':eventDate,'eDate2':eventDate2,'slots':slots,'doctor':doctor},
                     type:'POST',
                     success:function(data){
                        // $('#accordion').html(data);
                        // alert(data);
                        window.location.href = '';
                     },
                     error:function(){
                     }
                });
            }
        });
        $('#schedule-investigation_id').on('change', function() {
            var option = this.value;
            $('#add_schedule_button').css('display','block');
            $.ajax({
                url:baseurl+'schedule/get-investigation-schedule',
                data:{'option':option},
                type:'POST',
                success:function(data){
                    var result = JSON.parse(data);

                    if(typeof(result[0]) != 'undefined') 
                    {                    
                        $('#schedule-amount').val(result[0]['amount']);
                        // alert(result[0]['isHomeCollection']);
                        if(result[0]['isHomeCollection']=='1'){
                                $('#schedule-ishomecollection').val(1);
                                $('#schedule-ishomecollection').attr('checked','true');
                            }else{
                                 $('#schedule-ishomecollection').attr('checked','false');
                                $('#schedule-ishomecollection').val(0);
                            }
                    }else
                    {
                        
                        $('#schedule-ishomecollection').attr('checked', false);
                       
                         $('#schedule-ishomecollection').val(0);
                        $('#schedule-amount').val(null);
                    }
                    // $.each($('#schedule_calendar').fullCalendar('clientEvents'), function (i, item) {
                    //  $('#schedule_calendar').fullCalendar('removeEvents', item.id);
                    // });
                    $('#schedule_calendar').fullCalendar('destroy');
                    $.CalendarApp1.init();
                },
                error:function(){
                }
            });
        });

        $('#schedule-doctor_id').on('change', function() {
            // $.each($('#schedule_calendar').fullCalendar('clientEvents'), function (i, item) {
            //  $('#schedule_calendar').fullCalendar('removeEvents', item.id);
            // });
            $('#schedule_calendar').fullCalendar('destroy');
            $.CalendarApp1.init();
            $('#add_schedule_button').css('display','block');
        });
        var date_diff_indays = function(date1,date2 ) {
          dt1 = new Date(date1);
          dt2 = new Date(date2);

          return Math.floor((Date.UTC(dt2.getFullYear(), dt2.getMonth(), dt2.getDate()) - Date.UTC(dt1.getFullYear(), dt1.getMonth(), dt1.getDate()) ) /(1000 * 60 * 60 * 24));
          }
           $('#add_schedule_button').click(function(){
            $('#add_schedule_event').modal('toggle');
            });

});

");
        ?>