<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PaymentDetails */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payment-details-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'patient_id')->textInput() ?>

    <?= $form->field($model, 'hospital_clinic_id')->textInput() ?>

    <?= $form->field($model, 'treatment_history_id')->textInput() ?>

    <?= $form->field($model, 'slot_day_time_mapping_id')->textInput() ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mode_payment')->textInput() ?>

    <?= $form->field($model, 'pay_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
