<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Refund */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="refund-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'razorpay_refund_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'razorpay_payment_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'razorpay_order_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'booking_id')->textInput() ?>

    <?= $form->field($model, 'patient_id')->textInput() ?>

    <?= $form->field($model, 'doctor_id')->textInput() ?>

    <?= $form->field($model, 'investigation_id')->textInput() ?>

    <?= $form->field($model, 'hospital_clinic_id')->textInput() ?>

    <?= $form->field($model, 'app_date')->textInput() ?>

    <?= $form->field($model, 'app_time')->textInput() ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
