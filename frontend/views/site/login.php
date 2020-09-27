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

         <!-- form starts here -->
		<!-- <form action="#" method="post"> -->
			 <?php 
          $form = ActiveForm::begin(); 
            ?>
			<div class="agile-field-txt">
				<label> Email</label>
				 <?= $form->field($model, 'username')->textInput(['autofocus' => true,'placeholder' => 'Email'])->label(false); ?>
				<!-- <input type="text" name="name" placeholder="Enter User Name" required="" /> -->
			</div>
			<div class="agile-field-txt">
				<label> password</label>
				<!-- <input type="password" name="password" placeholder="Enter Password" required="" id="myInput" /> -->
				<?= $form->field($model, 'password')->passwordInput(['id' => 'myInput', 'placeholder' => 'password'])->label(false); ?>
				<!-- <div class="agile_label"> -->
					
					<!-- <input id="check3" name="check3" type="checkbox" value="show password" onclick="myFunction()"> -->
					<!-- <label class="check" for="check3">Show password</label> -->
				<!-- </div> -->
				<div class="agile-right">
					<a href="#">forgot password?</a>
				</div>
			</div>
			<!-- script for show password -->
			<script>
				function myFunction() {
					var x = document.getElementById("myInput");
					if (x.type === "password") {
						x.type = "text";
					} else {
						x.type = "password";
					}
				}
			</script>
			<!-- //end script -->
			<div class="w3ls-bot">
				<div class="switch-agileits">
					<!-- <label class="switch">
						<input type="checkbox">
						<span class="slider round"></span>
						keep me signed in
					</label> -->
				</div>
			</div>
			<?php //echo Html::submitButton('Login', ['name' => 'login-button']) ?>
				<input type="submit" value="SIGN IN">
				  <?php ActiveForm::end(); ?>
		<!-- </form> -->


        







