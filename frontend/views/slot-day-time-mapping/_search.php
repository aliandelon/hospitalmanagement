<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SlotDayTimeMappingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="slot-day-time-mapping-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'slot_day_id') ?>

    <?= $form->field($model, 'hospital_clinic_id') ?>

    <?= $form->field($model, 'doctor_id') ?>

    <?= $form->field($model, 'investigation_id') ?>

    <?php // echo $form->field($model, 'from_time') ?>

    <?php // echo $form->field($model, 'to_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
