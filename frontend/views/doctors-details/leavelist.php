<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DoctorsDetailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Doctors Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Doctors Leave List</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-xs-12 col-md-12" style="padding: 50px 15px;">
                        <label>Select Date</label><input type="text" name="dates" class="form-control" style="width: 25%;"/>
                    </div>
                </div>
                    <div class="row doctor-grid">
                        <?php foreach ($doctorsList as $key => $value) { 
                            $id = $value['id'];
                            $path = Yii::$app->request->baseUrl .'/uploads/doctors/'.$id.'.'.$value['image'];
                            
                        ?>
                            <div class="col-md-4 col-sm-4  col-lg-3">
                                <div class="profile-widget">
                                    <div class="doctor-img">
                                        <a class="avatar" href="profile.html">
                                            <?php echo ($value['image'] != '') ? '<img alt="" src="'.$path.'">' : '<i class="fa fa-user-md fa-2x"></i>'?>
                                        </a>
                                    </div>
                                    <h4 class="doctor-name text-ellipsis"><a href="<?php echo Yii::$app->request->baseUrl .'/doctors-details/view?id='.$id?>"><?php echo isset($value['name']) ? $value['name'] : "";?></a></h4>
                                    <div class="doc-prof"><?php echo isset($value['leaveDate']) ? $value['leaveDate'] : "";?></div>
                                    <!-- <div class="user-country">
                                        <i class="fa fa-graduation-capr"></i> <?php //echo $months[$i]?>
                                    </div>  -->
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <!-- <div class="row">
                    <div class="col-sm-12">
                        <div class="see-all">
                            <a class="see-all-btn" href="javascript:void(0);">Load More</a>
                        </div>
                    </div>
                </div> -->
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script type="text/javascript">$('input[name="dates"]').daterangepicker();</script>
<script>
    var baseurl = '<?php print \yii\helpers\Url::base() . "/"; ?>';
  </script>
  <?php $this->registerJs("
     $(document).ready(function () {

        $('.applyBtn').html('View Doctors');
        $('.applyBtn').click(function(){
            var dates = $('input[name=\'dates\']').val();
            alert(dates);
            $.ajax({
                 url:baseurl+'doctors-details/leave-list-ajax',
                 data:{'dates':dates},
                 type:'POST',
                 success:function(data){
                        if(data==2)
                        {
                    
                        }
                        else{
                         $('.doctor-grid').html('');
                            $('.doctor-grid').append(data);
                        
                        }
                 },
                 error:function(){
                 }
            });
        });
      });
") ?>