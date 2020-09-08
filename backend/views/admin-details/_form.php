<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AdminDetails */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-details-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //$form->field($model, 'admin_id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password', ['options' => ['id' => 'passid']])->passwordInput(['maxlength' => true]) ?><span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password"></span>

    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?php
        echo $form->field($model, 'role_id')->dropDownList(
            ['1' => 'Role 1', '2' => 'Role 2', '3' => 'Role 3']
    ); ?>

    <?php
        echo $form->field($model, 'status')->dropDownList(
            ['1' => 'Active', '0' => 'Inactive']
    ); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
