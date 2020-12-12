<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RefundSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="refund-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'razorpay_refund_id') ?>

    <?= $form->field($model, 'razorpay_payment_id') ?>

    <?= $form->field($model, 'razorpay_order_id') ?>

    <?= $form->field($model, 'booking_id') ?>

    <?php // echo $form->field($model, 'patient_id') ?>

    <?php // echo $form->field($model, 'doctor_id') ?>

    <?php // echo $form->field($model, 'investigation_id') ?>

    <?php // echo $form->field($model, 'hospital_clinic_id') ?>

    <?php // echo $form->field($model, 'app_date') ?>

    <?php // echo $form->field($model, 'app_time') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
