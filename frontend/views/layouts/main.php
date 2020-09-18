<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;

//use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<?php
$selectHospitalId=common\models\HospitalClinicDetails::find()->where(['user_id'=>Yii::$app->user->identity->id])->one();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
        <head>
                <meta charset="<?= Yii::$app->charset ?>">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <?= Html::csrfMetaTags() ?>
                <title><?= Html::encode($this->title) ?></title>
                <?php $this->head() ?>
                <?php $actionArray = ['site'];$pageArray = ['index'];if (in_array(Yii::$app->controller->action->id , $pageArray) && in_array(Yii::$app->controller->id , $actionArray)) {
?>
<script type="text/javascript" src="<?php echo Yii::getAlias('@web') ?>/js/jquery-3.2.1.min.js"></script> 
<script type="text/javascript" src="<?php echo Yii::getAlias('@web') ?>/js/chart.js"></script> <?php }?>
        </head>
        <body>
                <?php $this->beginBody(); ?>
                 <div class="main-wrapper">
        <div class="header">
            <div class="header-left">
                <a href="index-2.html" class="logo">
                    <img src="<?= Yii::$app->request->baseUrl; ?>/img/logo.png" width="35" height="35" alt=""> <span>Preclinic</span>
                </a>
            </div>
            <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
            <ul class="nav user-menu float-right">
                <li class="nav-item dropdown d-none d-sm-block">
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
                </li>
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img">
                            <img class="rounded-circle" src="<?= Yii::$app->request->baseUrl; ?>/img/user.jpg" width="24" alt="Admin">
                            <span class="status online"></span>
                        </span>
                        <span>Admin</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="profile.html">My Profile</a>
                        <a class="dropdown-item" href="edit-profile.html">Edit Profile</a>
                        <a class="dropdown-item" href="settings.html">Settings</a>
                        <a class="dropdown-item" href="<?= Yii::$app->request->baseUrl . '/site/logout' ?>" data-method="post">Logout</a>
                    </div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.html">My Profile</a>
                    <a class="dropdown-item" href="edit-profile.html">Edit Profile</a>
                    <a class="dropdown-item" href="settings.html">Settings</a>
                    <a class="dropdown-item" href="login.html">Logout</a>
                </div>
            </div>
        </div>
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">Main</li>
                        <li class="active">
                            <a href="index-2.html"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                        </li>
                         <li>
                            <a href="<?= Yii::$app->request->baseUrl . '/hospital-clinic-details/update?id='.$selectHospitalId->id ?>"><i class="fa fa-cog"></i> <span>Settings</span></a>
                        </li>
                        <li>
                            <a href="<?= Yii::$app->request->baseUrl . '/schedule/index' ?>"><i class="fa fa-calendar-check-o"></i> <span>Schedule</span></a>
                        </li>
                        <li>
                            <a href="<?= Yii::$app->request->baseUrl . '/site/holiday' ?>"><i class="fa fa-calendar"></i> <span>Holiday</span></a>
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

