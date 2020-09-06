<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="imprint">
    <div class="container">
        <div class="row">

            <nav class="cl-effect-5">
                <a href="#"><span data-hover="Contact Us">Contact Us</span></a>

            </nav>
            <img class="center-block dots" src="<?= yii\helpers\Url::base() . '/images/dots.png' ?>">
            <div class="col-md-6">
                <!--<p>adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>-->

                <div class="bits">
                    <ul>
                        <li>
                            <p>mastermbbslearn@gmail.com</p>
                        </li>


                        <!--<li>
                            <p>Lorem lispum</p>

                        </li>-->

                    </ul>
                </div>

                <div class="clearfix"></div>
                <!-- <div class="social-icons">
                     <ul>
                         <li><a href="#"><i class="fa dev fa-facebook"></i></a></li>
                         <li><a href="#"><i class="fa dev fa-google-plus"></i></a></li>
                         <li><a href="#"><i class="fa dev fa-twitter"></i></a></li>

                         <li><a href="#"><i class="fa dev fa-linkedin"></i></a></li>

                         <li><a href="#"><i class="fa dev fa-pinterest"></i></a></li>
                         <li><a href="#"><i class="fa dev fa-skype"></i></a></li>
                         <li><a href="#"><i class="fa dev fa-youtube"></i></a></li>

                     </ul>

                 </div>-->
            </div>
            <div class="col-md-6">

                <?php if (Yii::$app->session->hasFlash('success')): ?>
                        <div class="alert alert-error alert-dismissable" style="text-align: center;">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            <h4><i class="icon fa fa-times"></i>Staus !</h4>
                            <?= Yii::$app->session->getFlash('success') ?>
                        </div>
                <?php endif; ?>
                <?php if (Yii::$app->session->hasFlash('error')): ?>
                        <div class="alert alert-error alert-dismissable" style="text-align: center;">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            <h4><i class="icon fa fa-times"></i>Sorry Failed !</h4>
                            <?= Yii::$app->session->getFlash('error') ?>
                        </div>
                <?php endif; ?>


                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <div class="form-group">
                    <?= $form->field($model, 'name')->textInput(['class' => 'form-new', 'autofocus' => true, 'placeholder' => 'name'])->label(FALSE) ?>
                </div>

                <div class="form-group">
                    <?= $form->field($model, 'email')->textInput(['class' => 'form-new', 'placeholder' => 'email'])->label(FALSE) ?>
                </div>

                <div class="form-group">
                    <?= $form->field($model, 'subject')->textInput(['class' => 'form-new', 'placeholder' => 'subject'])->label(FALSE) ?>
                </div>

                <div class="form-group">
                    <?= $form->field($model, 'body')->textarea(['class' => 'form-controlm', 'rows' => 6, 'placeholder' => 'subject'])->label(FALSE) ?>
                </div>


                <div class="form-group">
                    <?=
                    $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                    ])
                    ?>

                </div>

                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>


            </div>
        </div>
    </div>
</section>
