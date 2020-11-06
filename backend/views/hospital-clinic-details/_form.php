<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\HospitalClinicDetails */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hospital-clinic-details-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php
        echo $form->field($model, 'type')->dropDownList(
            ['1' => 'Hospital', '2' => 'Laboratory'],['id'=>'type']
    ); ?>

    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'have_diagnostic_center')->checkbox(['id' => 'clinicflag']);
    ?>

    <?php echo $form->field($model, 'same_as_hospital_details_flag')->checkbox(['disabled'=>true,'id' => 'hospitaldetailflag']);
    ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'pincode')->textInput() ?>

    <?= $form->field($model, 'street1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'street2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'area')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'latitude')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'longitude')->textInput(['maxlength' => true]) ?>

    <?php
        echo $form->field($model, 'status')->dropDownList(
            ['1' => 'Active', '0' => 'Inactive']
    ); ?>
    <dic class="addional-details" style="display: none;">
        <?= $form->field($model, 'lab_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'lab_phone_number')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'lab_email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'lab_address')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'lab_pincode')->textInput() ?>

        <?= $form->field($model, 'lab_street1')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'lab_street2')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'lab_city')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'lab_area')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'lab_latitude')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'lab_longitude')->textInput(['maxlength' => true]) ?>
    </dic>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

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
