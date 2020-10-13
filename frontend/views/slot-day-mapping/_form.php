<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SlotDayMapping */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="slot-day-mapping-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'investigation_id')->textInput() ?>

    <?= $form->field($model, 'hospital_clinic_id')->textInput() ?>

    <?= $form->field($model, 'day')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
