<div class="content">
    <div class="row">
        <div class="col-sm-8 col-4">
            <h4 class="page-title">Calendar</h4>
        </div>
        <div class="col-sm-4 col-8 text-right m-b-30" id="addBtn">
            <a href="#" class="btn btn-primary btn-rounded" onclick="$('#add_event').toggleClass('show')"><i class="fa fa-plus"></i> Add Holiday</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box mb-0">
                <div class="row">
                    <div class="col-md-12">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
            <!-- <div class="modal fade none-border" id="event-modal">
                <div class="modal-dialog">
                    <div class="modal-content modal-md">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Event</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body"></div>
                        <div class="modal-footer text-center">
                            <button type="button" class="btn btn-primary submit-btn save-event">Create event</button>
                            <button type="button" class="btn btn-danger btn-lg delete-event" data-dismiss="modal">Delete</button>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- <div class="modal fade none-border show" id="event-modal" aria-modal="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content modal-md">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Event</h4>
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>
                        <div class="modal-body"><form><div class="row"><div class="col-md-6"><div class="form-group"><label>Event Name</label><input class="form-control" type="text" name="title"></div></div><div class="col-md-6"><div class="form-group"><label>Category</label><select class="select form-control" name="category"><option value="bg-danger">Danger</option><option value="bg-success">Success</option><option value="bg-info">Info</option><option value="bg-primary">Primary</option><option value="bg-warning">Warning</option></select></div></div></div></form></div>
                        <div class="modal-footer text-center">
                            <button type="button" class="btn btn-primary submit-btn save-event">Create event</button>
                            <button type="button" class="btn btn-danger btn-lg delete-event" data-dismiss="modal" style="display: none;">Delete</button>
                        </div>
                    </div>
                </div>
            </div> -->
            <div id="add_event" class="modal in " role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content modal-md">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Holiday</h4>
                            <button type="button" class="close" id="close" onclick="$('#add_event').toggleClass('show')">&times;</button>
                        </div>
                        <div class="modal-body">
                            <!-- <form> -->
                                 <div class="form-group">
                                    <label>Entry Type<span class="text-danger">*</span></label>
                                    <select class="form-control" id="holidayFlag">
                                        <option value="">Select Holiday Type</option>
                                        <option value="1">Holiday</option>
                                        <option value="0">Others</option>
                                    </select>
                                </div>
                                <div class="form-group" id="appointDiv" style="display: none">
                                    <label>Appointment Type<span class="text-danger">*</span></label>
                                    <select class="form-control" id="appointType">
                                        <option value="">Select Appointment Type</option>
                                        <option value="1">Doctors Appointment</option>
                                        <option value="0">Investigation Appointment</option>
                                    </select>
                                </div>
                                <div class="form-group" id="InvestigationDiv" style="display: none">
                                    <label>Investigations List<span class="text-danger">*</span></label>
                                    <select class="form-control" id="Investigation" data-live-search="true">
                                        <option value="">Select Investigation</option>
                                        <?php foreach ($list as $key => $value) {
                                           echo "<option value='".$value['id']."'>".$value['name']."</option>";
                                        }?>
                                    </select>
                                </div>
                                <div class="form-group" id="DoctorDiv" style="display: none">
                                    <label>Doctors List<span class="text-danger">*</span></label>
                                    <select class="form-control" id="doctor" data-live-search="true">
                                        <option value="">Select Doctors</option>
                                        <?php foreach ($doctors as $key => $value) {
                                           echo "<option value='".$value['id']."'>".$value['name']."</option>";
                                        }?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Date <span class="text-danger">*</span></label>
                                    <div class="cal-icon">
                                        <input class="form-control datetimepicker" type="text" id="eventDate">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Reason <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" id="eventName">
                                </div>
                                <div class="m-t-20 text-center">
                                    <button class="btn btn-primary submit-btn">Create Holiday</button>
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
.fc-time{
    display:none;
}
div .bootstrap-select{
    display:none;
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
        $('#Investigation').selectpicker();
        $('#doctor').selectpicker();
                // $(function() {
                 
                // });
                $('#addBtn').click(function(){
                        $('#eventName').val('');
                        $('#eventDate').val('');
                        $('#holidayFlag').val('');
                        $('#Investigation').val('');  
                        $('#appointType').val('');
                        $('#doctor').val('');
                });
                $('.submit-btn').on('click',function(e){
                        e.preventDefault();
                        var events = $('#eventName').val();
                        var eventDate = $('#eventDate').val();
                        var holidayFlag = $('#holidayFlag').val();
                        var invVal = $('#Investigation').val();
                        var investigation = (holidayFlag!=1) ? invVal : '0';    
                        var appointType = $('#appointType').val();
                        var doctor  = $('#doctor').val();
                        $.ajax({
                             url:baseurl+'site/event',
                             data:{'name':events,'eDate':eventDate,'holidayFlag':holidayFlag,'investigation':investigation,'appointType': appointType,'doctor':doctor},
                             type:'POST',
                             success:function(data){
                                // $('#accordion').html(data);
                                // alert(data);
                                window.location.href = '';
                                $('#add_event').toggleClass('show')
                             },
                             error:function(){
                             }


                        });


                });
                $('#holidayFlag').change(function(){
                    if($(this).val()!=1){
                        $('#appointDiv').show();   
                        $('#appointDiv').val(1); 
                        $('#DoctorDiv').show();
                    }else{
                        $('#appointDiv').hide();
                        $('#InvestigationDiv').hide();
                        $('#DoctorDiv').hide();   
                    }
                });
                $('#appointType').change(function(){
                    if($(this).val()!=1){
                        $('#InvestigationDiv').show();   
                        $('#DoctorDiv').hide();
                    }else{
                        $('#InvestigationDiv').hide();
                        $('#DoctorDiv').show();   
                    }
                });
        });
        ");
        ?>