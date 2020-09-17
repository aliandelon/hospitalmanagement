<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\DoctorsDetails */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="doctors-details-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'hospital_clinic_id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gender')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'registration_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'experience')->textInput() ?>

    <?= $form->field($model, 'profile_image')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'specialty_id')->textInput() ?>

    <?= $form->field($model, 'qualifications')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'created_on')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
