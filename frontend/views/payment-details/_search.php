<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PaymentDetailsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payment-details-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'patient_id') ?>

    <?= $form->field($model, 'hospital_clinic_id') ?>

    <?= $form->field($model, 'treatment_history_id') ?>

    <?= $form->field($model, 'slot_day_time_mapping_id') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'mode_payment') ?>

    <?php // echo $form->field($model, 'pay_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
