<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Appointments */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="appointments-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'patient_id')->textInput() ?>

    <?= $form->field($model, 'doctor_id')->textInput() ?>

    <?= $form->field($model, 'investigation_id')->textInput() ?>

    <?= $form->field($model, 'slot_day_time_mapping_id')->textInput() ?>

    <?= $form->field($model, 'hospital_clinic_id')->textInput() ?>

    <?= $form->field($model, 'app_date')->textInput() ?>

    <?= $form->field($model, 'app_time')->textInput() ?>

    <?= $form->field($model, 'appointment_type')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
