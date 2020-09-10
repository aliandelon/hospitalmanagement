<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\DashboardAsset;
use yii\helpers\Html;
//use yii\bootstrap\Nav;
//use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;

//use common\widgets\Alert;

DashboardAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
        <head>
                <meta charset="<?= Yii::$app->charset ?>">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <?= Html::csrfMetaTags() ?>
                <title><?= Html::encode($this->title) ?></title>

                <script type="text/javascript">
                        var baseurl = "<?php print \yii\helpers\Url::base(); ?>";
                        var basepath = "<?php print \yii\helpers\Url::base(); ?>";

                </script>
                <?php $this->head() ?>
                <script src="/hospitalmanagement/admin/js/vendor/modernizr-2.8.3.min.js"></script>


        </head>
        <body>
                <?php $this->beginBody() ?>

                <div class="left-sidebar-pro">
        <nav id="sidebar" class="">
            <div class="sidebar-header">
                <a href="index.html"><img class="main-logo" src="<?= Yii::$app->request->baseUrl; ?>/img/logo/logo.png" alt="" /></a>
                <strong><a href="index.html"><img src="<?= Yii::$app->request->baseUrl; ?>/img/logo/logosn.png" alt="" /></a></strong>
            </div>
            <div class="left-custom-menu-adp-wrap comment-scrollbar">
                <nav class="sidebar-nav left-sidebar-menu-pro">
                    <ul class="metismenu" id="menu1">
                       
                            <?=\yii\widgets\Menu::widget([
                                'options' => ['class' => 'sidebar-menu treeview'],
                                'items' => [

                                    // roles start here
                                    ['label' => '<span class="educate-icon educate-apps icon-wrap"></span>&nbsp;<span class="menulist">Roles<i class="fa fa-angle-left pull-right"></i></span>', 
                                    'url' => ['#'],
                                        'template' => '<a href="{url}" >{label}</a>',
                                        'items' => [ 

                                    ['label' => '<span class="glyphicon glyphicon-user"></span>&nbsp;<span class="menulist">List Roles</span>', 'url' => ['/admin-details/create']],
                                    ['label' => '<span class="glyphicon glyphicon-user"></span>&nbsp;<span class="menulist">List Admin Details</span>', 'url' => ['/admin-details/index']],
                                ],],

                                // roles end here
                                 // user roles start here
                                    ['label' => '<span class="educate-icon educate-apps icon-wrap"></span>&nbsp;<span class="menulist">Assign Roles<i class="fa fa-angle-left pull-right"></i></span>', 
                                    'url' => ['#'],
                                        'template' => '<a href="{url}" >{label}</a>',
                                        'items' => [ 

                                    ['label' => '<span class="glyphicon glyphicon-user"></span>&nbsp;<span class="menulist">List Assigned Roles</span>', 'url' => ['/user-roles-mapping/index']],
                                    ['label' => '<span class="glyphicon glyphicon-user"></span>&nbsp;<span class="menulist">Assign New Roles</span>', 'url' => ['/user-roles-mapping/create']],
                                ],],
                                // user roles end
                                    ['label' => '<span class="glyphicon glyphicon-th"></span>&nbsp;<span class="menulist">Admin<i class="fa fa-angle-left pull-right"></i></span>', 
                                    'url' => ['#'],
                                        'template' => '<a href="{url}" >{label}</a>',
                                        'items' => [ 

                                    ['label' => '<span class="glyphicon glyphicon-user"></span>&nbsp;<span class="menulist">Create Admin Details</span>', 'url' => ['/admin-details/create']],
                                    ['label' => '<span class="glyphicon glyphicon-user"></span>&nbsp;<span class="menulist">List Admin Details</span>', 'url' => ['/admin-details/index']],
                                ],],

                                ['label' => '<span class="glyphicon glyphicon-list-alt"></span>&nbsp;<span class="menulist">Category<i class="fa fa-angle-left pull-right"></i></span>', 
                                    'url' => ['#'],
                                        'template' => '<a href="{url}" >{label}</a>',
                                        'items' => [ 

                                    ['label' => '<span class="glyphicon glyphicon-user"></span>&nbsp;<span class="menulist">Create Category</span>', 'url' => ['/category/create']],
                                    
                                    ['label' => '<span class="glyphicon glyphicon-search"></span>&nbsp;<span class="menulist">List Category</span> ', 'url' => ['/category/index']],
                                    
                                ],],    





                            ['label' => '<span class="glyphicon glyphicon-search"></span></span>&nbsp;<span class="menulist">Investigation<i class="fa fa-angle-left pull-right"></i></span>', 
                                    'url' => ['#'],
                                        'template' => '<a href="{url}" >{label}</a>',
                                        'items' => [ 

                                    ['label' => '<span class="glyphicon glyphicon-user"></span>&nbsp;<span class="menulist">Create Investigations</span>', 'url' => ['/investigations/create']],
                                    
                                    ['label' => '<span class="glyphicon glyphicon-search"></span>&nbsp;<span class="menulist">List Investigation</span> ', 'url' => ['/investigations/index']],
                                    
                                ],],    

                                



                                ['label' => '<span class="glyphicon glyphicon-plus"></span>&nbsp;<span class="menulist">New Request</span>', 
                                    'url' => ['hospital-clinic-details/index'],
                                    ]
                                    
                                ],
                                'submenuTemplate' => "\n<ul class='treeview-menu'>\n{items}\n</ul>\n",
                                'encodeLabels' => false, //allows you to use html in labels
                                'activateParents' => true,   ]);  ?>
                        
                    </ul>
                </nav>
            </div>
        </nav>
    </div>
                        


        <div class="header-advance-area">
            <div class="header-top-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="header-top-wraper">
                                <div class="row">
                                    <div class="col-lg-1 col-md-0 col-sm-1 col-xs-12">
                                        <div class="menu-switcher-pro">
                                            <button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
                                                    <i class="glyphicon glyphicon-th-list"></i>
                                                </button>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-7 col-sm-6 col-xs-12">
                                        <div class="header-top-menu tabl-d-n">
                                            
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                        <div class="header-right-info">
                                            <ul class="nav navbar-nav mai-top-nav header-right-menu">
                                            <li class="nav-item">
                                                <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                    <img src="<?= Yii::$app->request->baseUrl; ?>/img/product/pro4.jpg" alt="" />
                                                        <span class="admin-name">Prof.Anderson</span>
                                                            <i class="fa fa-angle-down edu-icon edu-down-arrow"></i>
                                                </a>
                                                <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated zoomIn">
                                                    <li><a href="#"><span class="edu-icon edu-home-admin author-log-ic"></span>My Account</a>
                                                    </li>
                                                    <li><a href="#"><span class="edu-icon edu-user-rounded author-log-ic"></span>My Profile</a>
                                                    </li>
                                                    <li><a href="#"><span class="edu-icon edu-money author-log-ic"></span>User Billing</a>
                                                    </li>
                                                    <li><a href="#"><span class="edu-icon edu-settings author-log-ic"></span>Settings</a>
                                                    </li>
                                                    <li><a href="<?= Yii::$app->request->baseUrl . '/site/logout' ?>" data-method="post"><span class="edu-icon edu-locked author-log-ic"></span>Log Out</a>
                                                    </li>
                                                </ul>
                                            </li>
                                                <li class="nav-item nav-setting-open"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="educate-icon educate-menu"></i></a>

                                                    <div role="menu" class="admintab-wrap menu-setting-wrap menu-setting-wrap-bg dropdown-menu animated zoomIn">
                                                        <ul class="nav nav-tabs custon-set-tab">
                                                            <li class="active"><a data-toggle="tab" href="#Notes">Notes</a>
                                                            </li>
                                                            <li><a data-toggle="tab" href="#Projects">Projects</a>
                                                            </li>
                                                            <li><a data-toggle="tab" href="#Settings">Settings</a>
                                                            </li>
                                                        </ul>

                                                        <div class="tab-content custom-bdr-nt">
                                                            <div id="Notes" class="tab-pane fade in active">
                                                                <div class="notes-area-wrap">
                                                                    <div class="note-heading-indicate">
                                                                        <h2><i class="fa fa-comments-o"></i> Latest Notes</h2>
                                                                        <p>You have 10 new message.</p>
                                                                    </div>
                                                        <div class="notes-list-area notes-menu-scrollbar">
                                                                <ul class="notes-menu-list">
                                                                     <li>
                                                                <a href="#">
                                                        <div class="notes-list-flow">
                                                            <div class="notes-img">
                                                            <img src="<?= Yii::$app->request->baseUrl; ?>/img/contact/4.jpg" alt="" />
                                                            </div>
                                                        <div class="notes-content">
                                                        <p> The point of using Lorem Ipsum is that it has a more-or-less normal.</p>
                                                        <span>Yesterday 2:45 pm</span>
                                                     </div>
                                                    </div>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <div class="notes-list-flow">
                                                            <div class="notes-img">
                                                            <img src="<?= Yii::$app->request->baseUrl; ?>/img/contact/1.jpg" alt="" />
                                                        </div>
                                                        <div class="notes-content">
                                                    <p> The point of using Lorem Ipsum is that it has a more-or-less normal.</p>
                                                <span>Yesterday 2:45 pm</span>
                                                    </div>
                                                                         </div>
                                                                                </a>
                                                                            </li>
                                                    <li>
                                                            <a href="#">
                                                            <div class="notes-list-flow">
                                                         <div class="notes-img">
                                                             <img src="<?= Yii::$app->request->baseUrl; ?>/img/contact/2.jpg" alt="" />
                                                                                        </div>
                                                                                        <div class="notes-content">
                                                                                            <p> The point of using Lorem Ipsum is that it has a more-or-less normal.</p>
                                                                                            <span>Yesterday 2:45 pm</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                           
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="Projects" class="tab-pane fade">
                                                                <div class="projects-settings-wrap">
                                                                    <div class="note-heading-indicate">
                                                                        <h2><i class="fa fa-cube"></i> Latest projects</h2>
                                                                        <p> You have 20 projects. 5 not completed.</p>
                                                                    </div>
                                                                    <div class="project-st-list-area project-st-menu-scrollbar">
                                                                        <ul class="projects-st-menu-list">
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="project-list-flow">
                                                                                        <div class="projects-st-heading">
                                                                                            <h2>Web Development</h2>
                                                                                            <p> The point of using Lorem Ipsum is that it has a more or less normal.</p>
                                                                                            <span class="project-st-time">1 hours ago</span>
                                                                                        </div>


                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                           
                                                                            
                                                                            
                                                                            
                                                                            
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="Settings" class="tab-pane fade">
                                                                <div class="setting-panel-area">
                                                                    <div class="note-heading-indicate">
                                                                        <h2><i class="fa fa-gears"></i> Settings Panel</h2>
                                                                        <p> You have 20 Settings. 5 not completed.</p>
                                                                    </div>
                                                                    <ul class="setting-panel-list">
                                                            <li>
                                                                <div class="checkbox-setting-pro">
                                                                    <div class="checkbox-title-pro">
                                                                        <h2>Show notifications</h2>
                                                                    <div class="ts-custom-check">
                                                                    <div class="onoffswitch">
            <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example">
            <label class="onoffswitch-label" for="example">
            <span class="onoffswitch-inner"></span>
            <span class="onoffswitch-switch"></span>
                </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        
                                                                        
                                                                      
                                                                    </ul>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu start -->
          
            <!-- Mobile Menu end -->
            <div class="breadcome-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="breadcome-list">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="breadcome-heading">
                                            <form role="search" class="sr-input-func">
                                              <!--   <input type="text" placeholder="Search..." class="search-int form-control">
                                                <a href="#"><i class="fa fa-search"></i></a> -->
                                            </form>
                                        </div>
                                    </div>
                                    <!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <ul class="breadcome-menu">
                                            <li><a href="#">Home</a> <span class="bread-slash">/</span>
                                            </li>
                                            <li><span class="bread-blod">Dashboard V.1</span>
                                            </li>
                                        </ul>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="static-table-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="content-div">
                        <?= $content ?>
                    </div>
                    </div>
                </div>
            </div>
            <div class="footer-copyright-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="footer-copy-right">
                                <p>Copyright © <?=date("Y")?>. All rights reserved. Template by <a href="https://colorlib.com/wp/templates/">Colorlib</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

                        <?php $this->endBody() ?>
        </body>
</html>
<?php $this->endPage() ?>
