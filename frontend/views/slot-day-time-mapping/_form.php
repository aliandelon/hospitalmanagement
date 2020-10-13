<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SlotDayTimeMapping */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="slot-day-time-mapping-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'slot_day_id')->textInput() ?>

    <?= $form->field($model, 'hospital_clinic_id')->textInput() ?>

    <?= $form->field($model, 'from_time')->textInput() ?>

    <?= $form->field($model, 'to_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
