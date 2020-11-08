<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;
use common\models\HolidayList;

//use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<?php
$selectHospitalId=common\models\HospitalClinicDetails::find()->where(['user_id'=>Yii::$app->user->identity->id])->one();
$layoutModel = new HolidayList();
$publishData= $layoutModel->publish(Yii::$app->user->identity->id);
$publishData = $publishData[0]['flag'];
$publishFlag = ($selectHospitalId['publish_flag'] != 0 && $publishData != 0) ? 'checked' : '';
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
        <head>
                <meta charset="<?= Yii::$app->charset ?>">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <?= Html::csrfMetaTags() ?>
                <title><?= Html::encode($this->title) ?></title>
                <?php $this->head() ?>
                  <link rel="icon" type="image/png" href="<?= Yii::$app->request->baseUrl; ?>/img/logo/logo.png"/>
                <?php $actionArray = ['site'];$pageArray = ['index'];
if (in_array(Yii::$app->controller->action->id , $pageArray) && in_array(Yii::$app->controller->id , $actionArray)) {
?>
<style>
.header-left{
    background-color: #fff !important;
}
</style>
<script type="text/javascript">
    var baseurl = "<?php print \yii\helpers\Url::base() . "/"; ?>";
    var basepath = "<?php print \yii\helpers\Url::base(); ?>";
    var curl = "<?php print Yii::$app->request->absoluteUrl; ?>";
</script>
<script type="text/javascript" src="<?php echo Yii::getAlias('@web') ?>/js/jquery-3.2.1.min.js"></script> 
<script type="text/javascript" src="<?php echo Yii::getAlias('@web') ?>/js/chart.js"></script> <?php }?>
        </head>
        <style>
            .header-left {
                background-color: #fff !important;
            }
        </style>
        <body>
                <?php $this->beginBody(); ?>
                 <div class="main-wrapper">
        <div class="header">
            <div class="header-left">
                <!-- <a href="<?= Yii::$app->request->baseUrl; ?>"><img class="main-logo" src="<?= Yii::$app->request->baseUrl; ?>/img/logo/logo.png" alt="" /></a>
                <strong><a href="<?= Yii::$app->request->baseUrl; ?>"><img src="<?= Yii::$app->request->baseUrl; ?>/img/logo/logosn.png" alt="" style="margin-left: 22px;" /></a></strong> -->
                <a href="<?= Yii::$app->request->baseUrl; ?>" class="logo">
                    <img src="<?= Yii::$app->request->baseUrl; ?>/img/logo/logosn.png" id="small" alt="" style="height: 94%;display:none" /> <img class="main-logo" src="<?= Yii::$app->request->baseUrl; ?>/img/logo/logo.png" style="width: 55%;display:block" id="big" alt="" />
                </a>
            </div>
            <a id="toggle_btn" href="javascript:void(0);" onclick="($('#big').css('display')!='none') ? $('#big').css('display','none') : $('#big').css('display','block');($('#small').css('display')!='none') ? $('#small').css('display','none') : $('#small').css('display','block')"><i class="fa fa-bars"></i></a>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
            <ul class="nav user-menu float-right">
                <li><span class='welcome'><?php echo ($selectHospitalId->name) ? 'Welcome '.$selectHospitalId->name.'&nbsp;&nbsp;|&nbsp;&nbsp;' : '';?></span></li>
                <li class="nav-item dropdown d-none d-sm-block">
                    <span style="color: #fff;font-weight:1000">Publish</span>
                    <label class="switch">

                        <input type="checkbox" name="publish" id="publish" <?php echo $publishFlag?>>
                        <span class="slider round"></span>
                    </label>
                    <input type="hidden" id="hospId" value="<?php echo Yii::$app->user->identity->id?>">
                    <!-- <a href="javascript:void(0);" id="open_msg_box" class="hasnotifications nav-link"><i class="fa fa-comment-o"></i> <span class="badge badge-pill bg-danger float-right">8</span></a> -->
                </li> 
               <!--  <li class="nav-item dropdown d-none d-sm-block">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><i class="fa fa-bell-o"></i> <span class="badge badge-pill bg-danger float-right">3</span></a>
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span>Notifications</span>
                        </div>
                        <div class="drop-scroll">
                            <ul class="notification-list">
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media">
                                            <span class="avatar">
                                                <img alt="John Doe" src="<?= Yii::$app->request->baseUrl; ?>/img/user.jpg" class="img-fluid">
                                            </span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title">John Doe</span> added new task <span class="noti-title">Patient appointment booking</span></p>
                                                <p class="noti-time"><span class="notification-time">4 mins ago</span></p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                             
                                
                            </ul>
                        </div>
                        <div class="topnav-dropdown-footer">
                            <a href="activities.html">View all Notifications</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown d-none d-sm-block">
                    <a href="javascript:void(0);" id="open_msg_box" class="hasnotifications nav-link"><i class="fa fa-comment-o"></i> <span class="badge badge-pill bg-danger float-right">8</span></a>
                </li> -->
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img">
                            <?php $img=($selectHospitalId->hospital_clinic_image=='')? Yii::$app->request->baseUrl.'/img/user.jpg':Yii::$app->request->baseUrl.'/uploads/hospitalClinicImage/'.$selectHospitalId->id.'/'.$selectHospitalId->id.'.'.$selectHospitalId->hospital_clinic_image ?>
                            <img  style="height: 25px !important" class="rounded-circle" src="<?= $img?>" width="24" alt="Admin">
                            <span class="status online"></span>
                        </span>
                        <span><?=Yii::$app->user->identity->email?></span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?= Yii::$app->request->baseUrl . '/hospital-clinic-details/update2?id='.$selectHospitalId->id ?>">My Profile</a>
                       <!--  <a class="dropdown-item" href="edit-profile.html">Edit Profile</a>
                        <a class="dropdown-item" href="settings.html">Settings</a> -->
                        <a class="dropdown-item" href="<?= Yii::$app->request->baseUrl . '/site/logout' ?>" data-method="post">Logout</a>
                    </div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="<?= Yii::$app->request->baseUrl . '/hospital-clinic-details/update2?id='.$selectHospitalId->id ?>">My Profile</a>
                    <!-- <a class="dropdown-item" href="edit-profile.html">Edit Profile</a>
                    <a class="dropdown-item" href="settings.html">Settings</a> -->
                    <a class="dropdown-item" href="login.html">Logout</a>
                </div>
            </div>
        </div>
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="active">
                            <a href="<?= Yii::$app->request->baseUrl; ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                        </li>
                        
                          <li class="submenu">
                            <a href="#"><i class="fa fa-calendar"></i> <span> Appointments </span> <span class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="<?= Yii::$app->request->baseUrl . '/appointments?type=1'?>">Today's Appointments</a></li>
                                <li><a href="<?= Yii::$app->request->baseUrl . '/appointments/index2'?>">All Appointments</a></li>
                               
                            </ul>
                        </li>
                         
                        <!-- <li>
                            <a href="doctors.html"><i class="fa fa-user-md"></i> <span>Doctors</span></a>
                        </li> -->
                        <li class="submenu">
                            <a href="#"><i class="fa fa-calendar"></i> <span> Doctors </span> <span class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="<?= Yii::$app->request->baseUrl . '/doctors-details/leave-list' ?>">Doctor's on Leave</a></li>
                                <li><a href="<?= Yii::$app->request->baseUrl . '/doctors-details' ?>">Doctors List</a></li>
                               
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="#"><i class="fa fa-user"></i> <span> Patients </span> <span class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="<?= Yii::$app->request->baseUrl . '/patient-details' ?>">Patients</a></li>
                                <li><a href="<?= Yii::$app->request->baseUrl . '/patient-details/reffered-patients' ?>">Reffered Patients</a></li>
                               
                            </ul>
                        </li>
                         <li>
                           <!--  <a href="<?php //echo Yii::$app->request->baseUrl . '/schedule/index' ?>"><i class="fa fa-calendar-check-o"></i> <span>Schedule</span></a> -->
                             <a href="<?= Yii::$app->request->baseUrl . '/schedule/create' ?>"><i class="fa fa-calendar-check-o"></i> <span>Schedule</span></a>
                            
                        </li>
                        
                        <li>
                            <a href="<?= Yii::$app->request->baseUrl . '/site/holiday' ?>"><i class="fa fa-calendar"></i> <span>Holiday</span></a>
                        </li>

                         <li>
                            <a href="<?= Yii::$app->request->baseUrl . '/hospital-clinic-details/update2?id='.$selectHospitalId->id ?>"><i class="fa fa-cog"></i> <span>My Profile</span></a>
                        </li>
                        <li>
                            <a href="<?= Yii::$app->request->baseUrl . '/payment-details' ?>"><i class="fa fa-money"></i> <span>Earnings</span></a>
                        </li>
                        <li>
                            <a href="<?= Yii::$app->request->baseUrl . '/packages' ?>"><i class="fa fa-money"></i> <span>Subscription</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>




        <div class="page-wrapper">
            <div class="content">

                

                <?= $content ?>

                <div class="notification-box">
                <div class="msg-sidebar notifications msg-noti">
                    <div class="topnav-dropdown-header">
                        <span>Messages</span>
                    </div>
                    <div class="drop-scroll msg-list-scroll" id="msg_list">
                        <ul class="list-box">
                            
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">T</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">Tarah Shropshire</span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="topnav-dropdown-footer">
                        <a href="chat.html">See all messages</a>
                    </div>
                </div>
            </div>

            
        </div>
    </div>

        </body>
</html>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage(); ?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $("#publish").change(function(){
        var hospId = $("#hospId").val();
        var flag = ($("#publish"). is(":checked") != false) ? 1 : 0
        $.ajax({
             url:baseurl+'site/publish',
             data:{'hospital':hospId,'publishFlag':flag},
             type:'POST',
             success:function(data){
                if(data!=0){
                    swal("Success!", "You Details are Published successfully!", "success");
                    $("#publish").prop('checked', true);
                }else{
                    if(flag!=0){
                        swal("Sorry!", "You must add some Doctors and Investigation details!", "error");
                    }else{
                        swal("Success!", "You Details are Unpublished!", "success");
                    }
                    $("#publish").prop('checked', false);
                }
             },
             error:function(){
             }
        });
    });
</script>