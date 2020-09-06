<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Service';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="demo-1 inner-banner" id="home">
    <div class="content">
        <div id="large-header" class="large-header" style="background-image: url(images/in2.jpg);">
            
            <div class="contents">
                <h1>Video lectures to simplify the complexities of the MBBS syllabus</h1>
                <!--<h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</h2>-->
                <div class="breadcrumbs">

                    <a href="<?= Yii::$app->request->baseUrl ?>">HOME</a>
                    <span><i class="fa fa-angle-right"></i></span>Services
                </div>

            </div>
            <div class="demo-overlay"></div>
        </div>
    </div>
</div>



<section class="ui-about">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!--                <h1>Welcome To Master mbbs</h1>-->

                <nav class="cl-effect-5">
                    <a href="#"><span data-hover="Services">Services</span></a>
                </nav>
                <img class="center-block dots" src="<?= Yii::$app->request->baseUrl . '/images/dots.png' ?>">
                <p>  <b>Mastermbbs</b>

                    offers easy to grasp online video lectures for the MBBS curriculum for the whole academic

                    year.  Currently the whole curriculum  of Biochemistry is accessible online. Anatomy and Physiology portions are
                    being uploaded.  <strong>Access to the videos lectures is presently offered free of cost to students.</strong> </p>

            </div>
        </div>
    </div>
</section>





<!--<section class="mbbs-services">
    <div class="container">
        <div class="row">
            <h1>Lorem ipsum Dummy Text</h1>
            <div class="col-md-4 zeros">
                <div class="services-main">
                    <div class="services-left">
                        <img src="images/s1.png">
                    </div>
                    <div class="services-right">
                        <h2>Lorem ipsum dolor sit</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut in elit ipsum. Mauris et suscipit velit. Lorem ipsum Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut in elit ipsum. Mauris et suscipit velit. Lorem ipsum dolor sit amet, </p>
                    </div>
                </div>

            </div>
            <div class="col-md-4 zeros">
                <div class="services-main">
                    <div class="services-left">
                        <img src="images/s2.png">
                    </div>
                    <div class="services-right">
                        <h2>Lorem ipsum dolor sit</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut in elit ipsum. Mauris et suscipit velit. Lorem ipsum dolor sit amet,Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut in elit ipsum. Mauris et suscipit velit. Lorem ipsum  </p>
                    </div>
                </div>

            </div>
            <div class="col-md-4 zeros">
                <div class="services-main">
                    <div class="services-left">
                        <img src="images/s3.png">
                    </div>
                    <div class="services-right">
                        <h2>Lorem ipsum dolor sit</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut in elit ipsum. Mauris et suscipit velit. Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut in elit ipsum. Mauris et suscipit velit. Lorem ipsum </p>
                    </div>
                </div>

            </div>

            <div class="col-md-4 zeros">
                <div class="services-main">
                    <div class="services-left">
                        <img src="images/s4.png">
                    </div>
                    <div class="services-right">
                        <h2>Lorem ipsum dolor sit</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut in elit ipsum. Mauris et suscipit velit. Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut in elit ipsum. Mauris et suscipit velit. Lorem ipsum </p>
                    </div>
                </div>

            </div>

            <div class="col-md-4 zeros">
                <div class="services-main">
                    <div class="services-left">
                        <img src="images/s5.png">
                    </div>
                    <div class="services-right">
                        <h2>Lorem ipsum dolor sit</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut in elit ipsum. Mauris et suscipit velit. Lorem ipsum dolor sit amet,Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut in elit ipsum. Mauris et suscipit velit. Lorem ipsum  </p>
                    </div>
                </div>

            </div>

            <div class="col-md-4 zeros">
                <div class="services-main">
                    <div class="services-left">
                        <img src="images/s6.png">
                    </div>
                    <div class="services-right">
                        <h2>Lorem ipsum dolor sit</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut in elit ipsum. Mauris et suscipit velit. Lorem ipsum dolor sit amet,Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut in elit ipsum. Mauris et suscipit velit. Lorem ipsum  </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>-->

<section class="parallax-small" id="parallax-2" style="background-position: 50% 0px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12 wid">
                <div class="test-1">
                    <h3>Subscribe</h3>
                    <h4>Newsletter</h4>
                </div>
                <div class="test-2">
                    <form class="form-inline" role="form">
                        <div class="form-group">

                            <input type="email" placeholder="Your Email Address" class="form-controls" id="email">
                        </div>
                        <button type="submit" class="btn btn-default subs"><i class="fa haha-email fa-send"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>