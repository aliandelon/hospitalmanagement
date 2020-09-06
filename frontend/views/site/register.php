<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;

$this->title = "mastermbbs Student Registration";
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="login">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="cl-effect-5">
                    <a href="#"><span data-hover="Register">Register</span></a>

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

                <p>Important Note:Currently access to the videos are being offered only by invitation or on recommendation by a Medical college Faculty member to a limited number of students.This is to help us interact better with the students and to provide further learning solutions based on the student group need.
                    If you desire to be considered for access to this site please register your name and details on the page , or mail us at mastermbbslearn@gmail.com.
                </p>
                <div class="new_form row">

                    <?php
                    $form = ActiveForm::begin([
                                'options' => ['role' => 'form',
                                    'enctype' => 'multipart/form-data'
                                ],
                                'id' => 'registraton-form',
                    ]);
                    ?>
                    <div class="form-group col-sm-6">
                        <?= $form->field($model, 'first_name')->textInput(['class' => 'form-new', 'maxlength' => true, 'placeholder' => 'First Name'])->label(FALSE) ?>
                    </div>

                    <div class="form-group col-sm-6">
                        <?= $form->field($model, 'last_name')->textInput(['class' => 'form-new', 'maxlength' => true, 'placeholder' => 'Last Name'])->label(FALSE) ?>
                    </div>

                    <div class="form-group col-sm-6">
                        <?= $form->field($model, 'user_id')->textInput(['class' => 'form-new', 'placeholder' => 'email', 'maxlength' => true])->label(FALSE) ?>
                    </div>


                    <div class="form-group col-sm-6">


                        <?=
                        $form->field($model, 'dob')->widget(DatePicker::className(), ['options' => ['class' => 'form-new', 'placeholder' => "Date of Birth", 'readonly' => true],
                            'clientOptions' => [
                                'changeMonth' => true,
                                'yearRange' => '1980:' . date('Y'),
                                'changeYear' => true,
                            ],
                        ])->label(FALSE)
                        ?>
                    </div>

                    <div class="form-group col-sm-6">
                        <?= $form->field($model, 'password')->passwordInput(['class' => 'form-new', 'maxlength' => true, 'placeholder' => 'Password'])->label(FALSE) ?>

                    </div>

                    <div class="form-group col-sm-6">
                        <?= $form->field($model, 'con_password')->passwordInput(['class' => 'form-new', 'maxlength' => true, 'placeholder' => 'Confirm Password'])->label(FALSE) ?>
                    </div>


                    <div class="form-group col-xs-12">
                        <?= $form->field($model, 'address')->textArea(['rows' => 5, 'class' => 'form-controlv', 'placeholder' => 'Address'])->label(false) ?>
                    </div>


                    <div class="form-group col-sm-6">
                        <?= $form->field($model, 'parent_email')->textInput(['class' => 'form-new', 'maxlength' => true, 'placeholder' => 'Parent Email'])->label(FALSE) ?>
                    </div>


                    <div class="form-group col-sm-6">
                        <?php $states = yii\helpers\ArrayHelper::map(\frontend\models\States::find()->where(['status' => 1])->all(), 'id', 'state_name') ?>
                        <?= $form->field($model, 'state')->dropDownList($states, ['class' => 'form-new', 'prompt' => 'Select State'])->label(FALSE) ?>
                    </div>


                    <div class="form-group col-sm-6">
                        <?php $mbbsyear = [1 => '1st year', 2 => '2nd year', 3 => '3rd year', 4 => '4th year']; ?>
                        <?= $form->field($model, 'mbbs_year')->dropDownList($mbbsyear, ['class' => 'form-new', 'prompt' => 'Select MBBS Year'])->label(FALSE) ?>
                    </div>

                    <div class="form-group col-sm-6">
                        <?= $form->field($model, 'college')->textInput(['class' => 'form-new', 'maxlength' => true, 'placeholder' => 'College'])->label(FALSE) ?>
                    </div>

                    <div class="form-group col-xs-12">
                        <?= $form->field($model, 'mobile_number')->textInput(['class' => 'form-new', 'maxlength' => true, 'placeholder' => 'Mobile Number'])->label(FALSE) ?>
                    </div>


                    <div class="form-group col-xs-12"></div>


                    <div class="form-group col-xs-12">
                        <?= Html::submitButton('Submit', ['class' => 'btn can1 btn-default', 'id' => 'registersubmit']) ?>
                        <?= Html::resetButton('Cancel', ['class' => 'btn can2 btn-default']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>


                </div>
            </div>
        </div>
    </div>
</section>
<!-- Modal -->
<div id="imageModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Manage Image</h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<?php
$this->registerJs("
        $('#students-country').on('change',function(){
        var countryid =  $(this).val();

        $.ajax({
            url: baseurl+'site/load-states',
            type : 'POST',
            data : {'countryid' : countryid},
            beforeSend:function(){
                $('#students-state').html('<option>Select State</option>');
              },
                success:function(data){
                   $.each(data,function(key,value){
                          $('#students-state').append('<option value='+key+'>'+value+'</option>');
                         });
                }

        });
       return false;

});"
);

$this->registerJs("
 $(document).ready(function () {
    $('#registraton-form').on('beforeSubmit', function (event, messages) {
        $('#registersubmit').attr('disabled', true)
        $('#registersubmit') . html('please wait....');
        return true;
    });
});
");

$this->registerJs(
        "$(document).ready(function() {
                        $('#upload_image').on('click',function(e){
						var url  = baseurl + 'site/image-upload';
                            $('#imageModal').modal('show')
                                .find('.modal-content')
                                .load(url);

                           });
                       });
          ");
