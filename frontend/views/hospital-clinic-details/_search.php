<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\HospitalClinicDetailsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hospital-clinic-details-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'phone_number') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'have_diagnostic_center') ?>

    <?php // echo $form->field($model, 'master_hospital_id') ?>

    <?php // echo $form->field($model, 'same_as_hospital_details_flag') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'pincode') ?>

    <?php // echo $form->field($model, 'street1') ?>

    <?php // echo $form->field($model, 'street2') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'area') ?>

    <?php // echo $form->field($model, 'latitude') ?>

    <?php // echo $form->field($model, 'longitude') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'package_id') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'commision_type') ?>

    <?php // echo $form->field($model, 'commision') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
