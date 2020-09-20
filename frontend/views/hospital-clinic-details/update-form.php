<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\HospitalClinicDetails */
/* @var $form yii\widgets\ActiveForm */
?>

<style type="text/css">
    .help-block{
        color:red !important;
    }
</style>
  <?php
                                if($model->have_diagnostic_center == '1' && $model->same_as_hospital_details_flag == 0){
                                    $displayVal="display: block;width:100%";
                                    $checkeddisplayFlag="false";


                                }else{
                                    $displayVal="display: none;width:100%";
                                    $checkeddisplayFlag="true";
                                }?>


<div class="content" style="background-color: #fff">

                <div class="row">
                    <div class="col-lg-8 offset-lg-2" style="margin-top: 16px;">
                        <?php 
                         // Yii::$app->session->setFlash('success', 'Successfully updated the details');
                            if(Yii::$app->session->hasFlash('success')):?>
                    <div class="alert alert-success" style="margin-top: 16px;">
                      <?php echo Yii::$app->session->getFlash('success'); ?>
                    </div>
                    <!--<div class="info">-->
                        <!--Yii::$app->session->getFlash('myMessage');-->
                        
                    <!--</div>-->
                <?php endif; ?>
                        <h4 class="page-title">Edit Details</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                         <?php $form = ActiveForm::begin(); ?>
                         <?php //echo $form->errorSummary($model); ?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                     <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                                       
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>
                                    </div>
                                </div>
                                <div class="col-sm-12">
									<div class="form-group">
								<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
									</div>
								</div>
                                  <div class="col-sm-6">
									<div class="form-group gender-select">
									<?php echo $form->field($model, 'have_diagnostic_center')->checkbox(['id' => 'clinicflag']);
    								?>
									</div>
                                </div>
                <div class="col-sm-6">
                <?php echo $form->field($model, 'same_as_hospital_details_flag')->checkbox(['disabled'=>$checkeddisplayFlag,'checked' => $checkeddisplayFlag,'id' => 'hospitaldetailflag']);
    			?>
                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>
                                    </div>
                                </div>
								<div class="col-sm-12">
                                    <div class="form-group">
                                        <?= $form->field($model, 'pincode')->textInput() ?>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-3">
									<div class="form-group">
									 <?= $form->field($model, 'street1')->textInput() ?>
									</div>
								</div>





								 <div class="col-sm-6 col-md-6 col-lg-3">
									<div class="form-group">
									 <?= $form->field($model, 'street2')->textInput() ?>
									</div>
								</div>
								 <div class="col-sm-6 col-md-6 col-lg-3">
									<div class="form-group">
									 <?= $form->field($model, 'city')->textInput() ?>
									</div>
								</div>
								 <div class="col-sm-6 col-md-6 col-lg-3">
									<div class="form-group">
									 <?= $form->field($model, 'area')->textInput() ?>
									</div>
								</div>




								<div class="addional-details" style="<?=$displayVal?>">
									<div class="col-md-6">
										<div class="form-group">
										 <?= $form->field($model, 'lab_name')->textInput() ?>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
										 <?= $form->field($model, 'lab_phone_number')->textInput() ?>
										</div>
									</div>
									<div class="col-sm-12">
										<div class="form-group">
										 <?= $form->field($model, 'lab_email')->textInput() ?>
										</div>
									</div>





									<div class="col-sm-12">
										<div class="form-group">
										 <?= $form->field($model, 'lab_address')->textInput() ?>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
										 <?= $form->field($model, 'lab_pincode')->textInput() ?>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
										 <?= $form->field($model, 'lab_street1')->textInput() ?>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
										 <?= $form->field($model, 'lab_street2')->textInput() ?>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
										 <?= $form->field($model, 'lab_city')->textInput() ?>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
										 <?= $form->field($model, 'lab_area')->textInput() ?>
										</div>
									</div>
									
 								</div>



                                
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn">Edit Details</button>
                            </div>
                       <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
            <?php $this->registerJs("
    $(document).ready(function() {
    	
        $('body').on('click', '#clinicflag', function() {
            if($('#clinicflag').prop('checked') == true){
                $('#hospitaldetailflag').attr('disabled', false);
                $('.addional-details').css('display', 'block');
            }else{
                $('#hospitaldetailflag').attr('disabled', true);
                $('.addional-details').css('display', 'none');
            }
        });
        $('body').on('change', '#type', function() {
            var type = $('#type').val();
            if(type == 2)
            {
                $('#clinicflag').prop('checked', false);
                $('#clinicflag').attr('disabled', true);
                $('#hospitaldetailflag').attr('disabled', true);
                $('#hospitaldetailflag').prop('checked', false);
                $('.addional-details').css('display', 'none');
            }else{
                $('#clinicflag').attr('disabled', false);
                $('#hospitaldetailflag').attr('disabled', true);
            }
        });
        $('body').on('click', '#hospitaldetailflag', function() {
            if($('#hospitaldetailflag').prop('checked') == true){
                $('.addional-details').css('display', 'none');
            }else{
                $('.addional-details').css('display', 'block');
            }
        });
    });
")
?>'