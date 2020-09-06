<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
//use yii\bootstrap\Nav;
//use yii\bootstrap\NavBar;
//use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;

//use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
        <head>
                <meta charset="<?= Yii::$app->charset ?>">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <?= Html::csrfMetaTags() ?>
                <title><?= Html::encode($this->title) ?></title>
                <?php $this->head() ?>

                <style type="text/css">

                        #preloader  {
                                position: absolute;
                                top: 0;
                                left: 0;
                                right: 0;
                                bottom: 0;
                                background-color: #fefefe;
                                z-index: 99;
                                height: 100%;
                        }

                        #status {
                                width: 320px;
                                height: 55px;
                                position: absolute;
                                left: 0;
                                right: 0;
                                top: 0;
                                bottom: 0;
                                background-image: url(ajax-loader.gif);
                                background-repeat: no-repeat;
                                background-position: center;
                                margin: auto;
                        }
                </style>
                <script>
                        (function (i, s, o, g, r, a, m) {
                                i['GoogleAnalyticsObject'] = r;
                                i[r] = i[r] || function () {
                                        (i[r].q = i[r].q || []).push(arguments)
                                }, i[r].l = 1 * new Date();
                                a = s.createElement(o),
                                        m = s.getElementsByTagName(o)[0];
                                a.async = 1;
                                a.src = g;
                                m.parentNode.insertBefore(a, m)
                        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

                        ga('create', 'UA-100205180-1', 'auto');
                        ga('send', 'pageview');

                </script>
                <meta name="google-site-verification" content="QO1tL9DUQQ3FYgq9W4Aq7TslsuKxdLYf9fHfp9oKkak" />
        </head>
        <body>
                <?php $this->beginBody(); ?>


                <div id="static_cnts" class="">
                        <header class="cf visible-xs visible-sm">

                                <div class="navigation">
                                        <nav>
                                                <a href="javascript:void(0)" class="smobitrigger ion-navicon-round"><span></span></a>
                                                <ul class="mobimenu">

                                                        <div id="cssmenu">
                                                                <ul>
                                                                        <li>
                                                                                <div class="form-mob">
                                                                                        <form action="action_page.php">
                                                                                                <input type="search" class="searchbox-two" name="googlesearch" placeholder="Search" vk_1a558="subscribed">
                                                                                        </form>
                                                                                </div>
                                                                        </li>
                                                                        <li><a href="<?php echo Yii::$app->getUrlManager()->createUrl('site/index'); ?>"><span> Home </span></a></li>
                                                                        <li><a href="<?php echo Yii::$app->getUrlManager()->createUrl('site/aboutus'); ?>"><span>About Us  </span></a></li>
                                                                        <li><a href="<?php echo Yii::$app->getUrlManager()->createUrl('site/services'); ?>"><span>Services</span></a></li>
                                                                        <li><a href="<?php echo Yii::$app->getUrlManager()->createUrl('site/contactus'); ?>"><span>Contact Us</span></a></li>
                                                                </ul>
                                                        </div>

                                                </ul>
                                        </nav>
                                </div>
                        </header>


                </div>
                <div id="static_cnt" class="">
                        <section class="headers-main">
                                <div class="container">
                                        <div class="row">
                                                <div class="col-md-4 col-sm-6 col-xs-6 mob-big">
                                                        <a href="<?= Yii::$app->request->baseUrl ?>" alt="mastermbbs"><img class="img-responsive" src="<?= Yii::$app->request->baseUrl . '/images/logo.png' ?>"/></a>
                                                </div>
                                                <div class="col-md-5  list-1 hidden-sm hidden-xs">
                                                        <ul>
                                                                <li><a href="<?php echo Yii::$app->getUrlManager()->createUrl('site/index'); ?>"><span> Home </span></a></li>
                                                                <li><a href="<?php echo Yii::$app->getUrlManager()->createUrl('site/aboutus'); ?>"><span>About Us  </span></a></li>
                                                                <li><a href="<?php echo Yii::$app->getUrlManager()->createUrl('site/services'); ?>"><span>Services</span></a></li>
                                                                <li><a href="<?php echo Yii::$app->getUrlManager()->createUrl('site/contactus'); ?>"><span>Contact Us</span></a></li>
                                                                <li><a href="<?php echo Yii::$app->getUrlManager()->createUrl('site/we-recommend'); ?>"><span> We Recommend</span></a></li>
                                                        </ul>
                                                </div>

                                                <div class="col-md-3 log col-xs-6 mob-small">
                                                        <ul class="home">
                                                                <?php if (Yii::$app->user->getIsGuest()) { ?>
                                                                        <li><a href="<?php echo Yii::$app->getUrlManager()->createUrl('site/login'); ?>">Login  </a></li>
                                                                        <li><a href="<?php echo Yii::$app->getUrlManager()->createUrl('site/register'); ?>">Register</a></li>
                                                                        <?php
                                                                } if (!Yii::$app->user->getIsGuest()) {

                                                                        echo "Hello " . yii::$app->user->identity->first_name . ",   ";
                                                                        ?>
                                                                        <li><a href="<?php echo Yii::$app->getUrlManager()->createUrl('site/logout'); ?>">Logout  </a></li>
                                                                <?php } ?>
                                                        </ul>
                                                </div>

                                        </div>
                                </div>
                        </section>
                </div>

                <?= $content ?>

                <section class="newsletter">
                        <div class="container">
                                <div class="row">

                                        <div class="col-md-4 col-sm-6 col-xs-6 six">
                                                <img class="min img-responsive" src="<?= Yii::getAlias('@web') ?>/images/logo.png">
                                                <!--<h6 class="hid">© Copyright 2016 Mastersynapses Pvt. Ltd.<br/>-->
                                                All Rights Reserved<br/>
                                                Developed By Intersmart</h6>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-6 six">
                                                <h4>CONTACT DETAILS</h4>
                                                <ul>
                                                        <li><a href="<?= Yii::$app->request->baseUrl ?>">Home</a></li>
                                                        <li><a href="<?= Yii::$app->request->baseUrl . '/site/aboutus' ?>">About Us</a></li>
                                                        <li><a href="<?= Yii::$app->request->baseUrl . '/site/services' ?>">Services</a></li>
                                                        <li><a href="<?= Yii::$app->request->baseUrl . '/site/contactus' ?>">Contact Us</a></li>
                                                        <?php if (Yii::$app->user->getIsGuest()) { ?>
                                                                <li><a href="<?= Yii::$app->request->baseUrl . '/site/login' ?>">Login</a></li>
                                                                <li><a href="<?= Yii::$app->request->baseUrl . '/site/register' ?>">Register</a></li>
                                                        <?php } if (!Yii::$app->user->getIsGuest()) { ?>
                                                                <li><a href="#">Logout</a></li>
                                                        <?php } ?>
                                                        <li> <a href='<?= Yii::$app->request->baseUrl . '/site/disclaimer' ?>'>Disclaimer</a> </li>
                                                        <li> <a href='<?= Yii::$app->request->baseUrl . '/site/terms-condition' ?>'>Terms & Conditions</a> </li>
                                                </ul>
                                        </div>
                                        <!-- <div class="col-md-2 col-sm-6 col-xs-6 six" style="display:none;">
                                             <h4>Find Us On</h4>
                                             <h3><a href="#">Facebook</a></h3>
                                             <h3><a href="#">Google+</a></h3>
                                             <h3><a href="#">Twitter</a></h3>
                                             </ul>
                                         </div>-->
                                        <div class="col-md-3 col-sm-6 col-xs-6 six">
                                                <h4>CONTACT DETAILS</h4>
                                                <p>mastermbbslearn@gmail.com</p>


                                                </h6>
                                        </div>

                                </div>
                        </div>
                </section>

        </body>
</html>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage(); ?>

