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

          <?php 
          $form = ActiveForm::begin(
                [
                    
                    'options' => [
                        'class' => 'login100-form validate-form'
                     ]
                ]
            ); 
            ?>
                    <!-- <form class="login100-form validate-form"> -->
					<span class="login100-form-logo">
						<!-- <i class="zmdi zmdi-landscape"></i> -->
						<img src="<?= Yii::$app->request->baseUrl; ?>/login/images/logosn.png" width="50%">
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						 <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class' => 'input100','placeholder' => 'Email'])->label(false); ?>
						<!-- <input class="input100" type="text" name="LoginForm[username]" placeholder="Email"> -->
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						 <?= $form->field($model, 'password')->passwordInput(['class' => 'input100', 'placeholder' => 'password'])->label(false); ?>
						<!-- <input class="input100" type="password" name="LoginForm[username]" placeholder="Password"> -->
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>


					<div class="container-login100-form-btn">
						<!-- <button class="login100-form-btn">
							Login
						</button> -->
						<?= Html::submitButton('Login', ['class' => 'login100-form-btn', 'name' => 'login-button']) ?>
					</div>

					<!-- <div class="text-center p-t-50">
						<a class="txt1" href="#">
							Forgot Password?
						</a>
					</div> -->
				<!-- </form> -->
                
        <?php ActiveForm::end(); ?>


        







