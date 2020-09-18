<div class="content">
    <div class="row">
        <div class="col-sm-8 col-4">
            <h4 class="page-title">Calendar</h4>
        </div>
        <div class="col-sm-4 col-8 text-right m-b-30">
            <a href="#" class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#add_event"><i class="fa fa-plus"></i> Add Event</a>
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
            <div id="add_event" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content modal-md">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Event</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <!-- <form> -->
                                <div class="form-group">
                                    <label>Event Name <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" id="eventName">
                                </div>
                                <div class="form-group">
                                    <label>Event Date <span class="text-danger">*</span></label>
                                    <div class="cal-icon">
                                        <input class="form-control datetimepicker" type="text" id="eventDate">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Type<span class="text-danger">*</span></label>
                                    <select class="form-control" id="holidayFlag">
                                        <option value="1">Holiday</option>
                                        <option value="0">Others</option>
                                    </select>
                                </div>
                                <div class="form-group" id="InvestigationDiv" style="display: none">
                                    <label>Investigation List<span class="text-danger">*</span></label>
                                    <select class="form-control" id="Investigation">
                                        <?php foreach ($list as $key => $value) {
                                           echo "<option value='".$value['id']."'>".$value['name']."</option>";
                                        }?>
                                    </select>
                                </div>
                                <div class="m-t-20 text-center">
                                    <button class="btn btn-primary submit-btn">Create Event</button>
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
                
                $('.submit-btn').on('click',function(e){
                        e.preventDefault();
                        var events = $('#eventName').val();
                        var eventDate = $('#eventDate').val();
                        var holidayFlag = $('#holidayFlag').val();
                        var invVal = $('#Investigation').val();
                        var investigation = (holidayFlag!=1) ? invVal : '0';    
                        $.ajax({
                             url:baseurl+'site/event',
                             data:{'name':events,'eDate':eventDate,'holidayFlag':holidayFlag,'investigation':investigation},
                             type:'POST',
                             success:function(data){
                                // $('#accordion').html(data);
                                // alert(data);
                                window.location.href = '';
                             },
                             error:function(){
                             }


                        });


                });
                $('#holidayFlag').change(function(){
                    if($(this).val()!=1){
                        $('#InvestigationDiv').show();   
                    }
                });
        });
        ");
        ?>