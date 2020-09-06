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
<div class="login-box">
    <div class="login-logo">
        <img src="<?= Url::base().'/dist/img/logo.png' ?>">
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">mastermbbs Admin Panel</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

        <div class="form-group has-feedback">

            <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class' => 'form-control'])->label(false); ?>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">

            <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control', 'placeholder' => 'password'])->label(false); ?>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
            <div class="col-xs-8">
                <div class="checkbox icheck">
                    <label>
                        <?= $form->field($model, 'rememberMe')->checkbox() ?>

                    </label>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>

            </div>
            <!-- /.col -->
        </div>
        <?php ActiveForm::end(); ?>


        <!-- /.social-auth-links -->

        <a href="#">I forgot my password</a><br>
       

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->








