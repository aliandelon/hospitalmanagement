<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="demo-1 inner-banner" id="home">
    <div class="content">
        <div id="large-header" class="large-header" style="background-image: url(images/inner.jpg);">
           
            <div class="contents">
                <h1>Video lectures to simplify the complexities of the MBBS syllabus</h1>
                <!--<h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</h2>-->
                <div class="breadcrumbs">

                    <a href="<?= Yii::$app->request->baseUrl ?>">HOME</a>
                    <span><i class="fa fa-angle-right"></i></span>About Us
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
                    <a href="#"><span data-hover="ABOUT US">ABOUT US</span></a>
                </nav>
                <img class="center-block dots" src="<?= Yii::$app->request->baseUrl . '/images/dots.png' ?>">
                <p>Founded by consultant doctors with the objective of fostering the careers of budding doctors for future, Master MBBS has

                    succeeded in demystifying and simplifying the MBBS syllabus for students. Even after undergoing the most

                    rigorous academic training, it is completely normal for MBBS students to feel under-prepared as they

                    head to the examination hall. As a group of experienced doctors who have found ourselves in similar

                    situations in our academic lives, we have created lecture videos that will help MBBS students to prepare for examinations in a systematic manner.</p>

                <p>The chapter-wise video lectures delivered by experienced medical faculty are intended to provide

                    students with clarity on the MBBS curriculum that they may have otherwise missed. The students should be  able to

                    use these videos as a helpful reference point as they gear up for the challenging examinations. The effectiveness of

                    these video lectures primarily centers on the simplicity and eloquence with which the faculty explain the

                    most complex topics in the MBBS syllabus. In addition to instilling a sense of preparedness in students, the

                    video lectures will also give each student the easiest access to essential learning points as they prepare for

                    their exams. The videos allow students to cross check doubts in different areas.</p>

            </div>
        </div>
    </div>
</section>
