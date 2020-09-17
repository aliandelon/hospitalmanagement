<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\DoctorsDetailsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="doctors-details-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'hospital_clinic_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'phone') ?>

    <?php echo $form->field($model, 'gender') ?>

    <?php echo $form->field($model, 'registration_no') ?>

    <?php echo $form->field($model, 'experience') ?>

    <?php echo $form->field($model, 'profile_image') ?>

    <?php echo $form->field($model, 'specialty_id') ?>

    <?php echo $form->field($model, 'qualifications') ?>

    <?php echo $form->field($model, 'address') ?>

    <?php echo $form->field($model, 'status') ?>

    <?php echo $form->field($model, 'created_on') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
