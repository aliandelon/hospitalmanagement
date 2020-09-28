<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AppointmentsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="appointments-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'patient_id') ?>

    <?= $form->field($model, 'doctor_id') ?>

    <?= $form->field($model, 'investigation_id') ?>

    <?= $form->field($model, 'slot_day_time_mapping_id') ?>

    <?php // echo $form->field($model, 'hospital_clinic_id') ?>

    <?php // echo $form->field($model, 'app_date') ?>

    <?php // echo $form->field($model, 'app_time') ?>

    <?php // echo $form->field($model, 'appointment_type') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
