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
<style type="text/css">
	.help-block{
		color:red;
	}
</style>
         <!-- form starts here -->
		<!-- <form action="#" method="post"> -->
			 <?php 
          $form = ActiveForm::begin(); 
            ?>
			 <!-- <form> -->
				 <div class="form-group" style="text-align: left;">
					<label for="exampleInputEmail1">Username</label>
					<?= $form->field($model, 'username')->textInput(['autofocus' => true, 'id' => 'username','placeholder' => 'Email'])->label(false); ?>
				</div>
				<div class="form-group" style="text-align: left;">
					<label for="exampleInputPassword1">Password</label>
						<?= $form->field($model, 'password')->passwordInput(['id' => 'password', 'placeholder' => 'password'])->label(false); ?>
						<!-- <input type="password" class="form-control" id="password" placeholder="Password"> -->
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group  form-check" style="text-align: left;">
							<input type="checkbox" class="form-check-input" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">Keep me signed In</label>
						</div>
					</div>
				<div class="col-md-6 text-right">
					<a href="#">Forgot Password?</a>
				</div>
				</div>
					<button type="submit" class="btn btn-block btn-custom">Login</button>
				<!-- </form> -->
				  <?php ActiveForm::end(); ?>
		<!-- </form> -->


        







