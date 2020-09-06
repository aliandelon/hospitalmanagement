<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

//print_r($student_details);
?>
<section class="login">
        <div class="container">
                <div class="row">
                        <div class="col-md-12">
                                <nav class="cl-effect-5">
                                        <a href="#"><span data-hover="Order Details">Order Details</span></a>

                                </nav>
                                <img class="center-block dots" src="<?= Yii::getAlias('@web') ?>/images/dots.png">
                                <?php if (Yii::$app->session->hasFlash('activation')): ?>
                                        <div class="alert alert-error alert-dismissable" style="text-align: center;">
                                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                                <h4><i class="icon fa fa-times"></i>Sorry Activation Failed !</h4>
                                                <?= Yii::$app->session->getFlash('activation') ?>
                                        </div>
                                <?php endif; ?>
                                <?php if (Yii::$app->session->hasFlash('register')): ?>
                                        <div class="alert alert-success alert-dismissable" style="text-align: center;">
                                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                                <h4><i class="icon fa fa-check"></i>Registered !</h4>
                                                <?= Yii::$app->session->getFlash('register') ?>
                                        </div>
                                <?php endif; ?>
                                <?php if (Yii::$app->session->hasFlash('registerError')): ?>
                                        <div class="alert alert-success alert-dismissable" style="text-align: center;">
                                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                                <h4><i class="icon fa fa-times"></i>Error!.......</h4>
                                                <?= Yii::$app->session->getFlash('registerError') ?>
                                        </div>
                                <?php endif; ?>


                                <div class="new_form row">

                                        <?php
                                        $form = ActiveForm::begin([
                                                    'options' => ['role' => 'form',
                                                    ],
                                                    'id' => 'plan-form',
                                        ]);
                                        ?>
                                        <div class="form-group col-sm-6">
                                                <label>Student Name:</label>

                                                <?php $student[$studentdetails->id] = $studentdetails->first_name; ?>
                                                <?= $form->field($model, 'student_id')->dropDownList($student, ['class' => 'form-new', 'maxlength' => true, 'placeholder' => 'First Name'])->label(FALSE) ?>
                                        </div>


                                        <div class="form-group col-sm-6">
                                                <label>Plan Name:</label>
                                                <?php $plan[$plandetails->plan_id] = $plandetails->name; ?>
                                                <?= $form->field($model, 'plan_id')->dropDownList($plan, ['class' => 'form-new', 'maxlength' => true, 'placeholder' => 'Plan Name'])->label(FALSE) ?>
                                        </div>

                                        <div class="form-group col-sm-6">
                                                <label>Student Email:</label>

                                                <?php /* <?= $form->field($model, 'student_email')->textInput(['class' => 'form-new', 'maxlength' => true, 'placeholder' => 'Student Email', 'value' => $studentdetails->user_id, 'readonly' => true])->label(FALSE) ?> */ ?>
                                                <input type="text"  class="form-new" name="plan_description" readonly="" placeholder="Email" value="<?php echo $studentdetails->user_id; ?>">
                                        </div>


                                        <div class="form-group col-sm-6">
                                                <label>Plan Short Description:</label>
                                                <input type="text"  class="form-new" name="plan_description" readonly="" placeholder="Description" value="<?php echo $plandetails->short_description ?>">
                                        </div>

                                        <div class="form-group col-sm-6">
                                                <label>Price:</label>
                                                <input type="text"  class="form-new" name="price" readonly="" placeholder="Price" value="<?php echo $plandetails->price ?>">
                                        </div>

                                        <div class="form-group col-xs-12">
                                                <div class="form-group col-xs-6">
                                                        <?= Html::submitButton('Checkout', ['class' => 'btn can1 btn-default', 'id' => 'registersubmit']) ?>
                                                        <?= Html::resetButton('Cancel', ['class' => 'btn can2 btn-default']) ?>
                                                </div>
                                        </div>

                                        <?php ActiveForm::end(); ?>


                                </div>
                        </div>
                </div>
        </div>
</section>

<?php /* <section class="login">
  <div class="container">
  <div class="row">
  <div class="col-md-12">
  <nav class="cl-effect-5">
  <a href="#"><span data-hover="Register">Order Details</span></a>

  </nav>
  <div class="new_form row">

  </div>

  </div>
  </div>
  </div>
  </section> */ ?>