<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="login">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="cl-effect-5">
                    <a href="#"><span data-hover="Login">Login</span></a>

                </nav>
                <?php if (Yii::$app->session->hasFlash('register')): ?>
                        <div class="alert alert-success alert-dismissable" style="text-align: center;">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            <h4><i class="icon fa fa-check"></i>Registered !</h4>
                            <?= Yii::$app->session->getFlash('register') ?>
                        </div>
                <?php endif; ?>
                <?php if (Yii::$app->session->hasFlash('activation')): ?>
                        <div class="alert alert-success alert-dismissable" style="text-align: center;">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            <h4><i class="icon fa fa-check"></i>Activated !</h4>
                            <?= Yii::$app->session->getFlash('activation') ?>
                        </div>
                <?php endif; ?>
                <img class="center-block dots" src="<?= Url::base() . '/images/dots.png' ?>">
                <div class="new_form loginMod">
                    <?php $form = ActiveForm::begin(['id' => 'login-form', 'options' => ['role' => 'form']]); ?>

                    <div class="form-group">
                        <?= $form->field($model, 'username')->input('email', ['autofocus' => true, 'class' => 'form-new', 'placeholder' => 'Email'])->label(false) ?>
                    </div>
                    <div class="form-group">
                        <?= $form->field($model, 'password')->passwordInput(['autofocus' => true, 'class' => 'form-new', 'placeholder' => 'Password'])->label(false)->label(false) ?>
                    </div>


                    <?= Html::submitButton('Login', ['class' => 'btn new-btn btn-default', 'name' => 'login-button']) ?>

                    <?php ActiveForm::end(); ?>
                    <div class="col-md-5 col-sm-5 col-xs-5 padd">
                        <a class="forgot" href="<?php echo Yii::$app->getUrlManager()->createUrl('site/register'); ?>">New User?</a>
                    </div>
                    <div class="col-md-7 col-sm-7 col-xs-7 padd">
                        <a class="new" href="<?php echo Yii::$app->getUrlManager()->createUrl('site/request-password-reset'); ?>"">Forgot your password</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
