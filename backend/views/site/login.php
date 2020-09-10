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

          <?php $form = ActiveForm::begin(
                [
                    
                    'options' => [
                        'class' => 'login100-form validate-form'
                     ]
                ]
            ); ?>
      

        
        
                    <form class="login100-form validate-form">
                    <span class="login100-form-title">
                        Admin Login
                    </span>

                    <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                        <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class' => 'input100','placeholder' => 'Email'])->label(false); ?>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate = "Password is required">
                        <?= $form->field($model, 'password')->passwordInput(['class' => 'input100', 'placeholder' => 'password'])->label(false); ?>
                      
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>
                    
                    <div class="container-login100-form-btn">
                          <?= Html::submitButton('Login', ['class' => 'login100-form-btn', 'name' => 'login-button']) ?>
                    </div>

                    <div class="text-center p-t-12">
                        <span class="txt1">
                            <!-- Forgot -->
                        </span>
                        <a class="txt2" href="#">
                            <!-- Username / Password? -->
                        </a>
                    </div>

                    <div class="text-center p-t-136">
                        <a class="txt2" href="#">
                           <!--  Create your Account -->
                            <!-- <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i> -->
                        </a>
                    </div>
                
        <?php ActiveForm::end(); ?>


        







