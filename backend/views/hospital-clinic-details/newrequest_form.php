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
            ['1' => 'Hospital', '2' => 'Clinic'],['id'=>'type']
    ); ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'password', ['options' => ['id' => 'passid']])->passwordInput(['maxlength' => true]) ?><span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password"></span>
    <?php
        echo $form->field($model, 'commision_type')->dropDownList(
            ['1' => 'Flat', '2' => 'Percentage']
    ); ?>
    <?= $form->field($model, 'commision')->textInput(['maxlength' => true]) ?>
     
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
