<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\StudentsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="students-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'stud_id') ?>

    <?= $form->field($model, 'first_name') ?>

    <?= $form->field($model, 'last_name') ?>

    <?= $form->field($model, 'password') ?>

    <?= $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'dob') ?>

    <?php // echo $form->field($model, 'native_place') ?>

    <?php // echo $form->field($model, 'parent_email') ?>

    <?php // echo $form->field($model, 'native_town') ?>

    <?php // echo $form->field($model, 'education') ?>

    <?php // echo $form->field($model, 'education_cat') ?>

    <?php // echo $form->field($model, 'mbbs_year') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'profile_info') ?>

    <?php // echo $form->field($model, 'cod') ?>

    <?php // echo $form->field($model, 'uod') ?>

    <?php // echo $form->field($model, 'field') ?>

    <?php // echo $form->field($model, 'field1') ?>

    <?php // echo $form->field($model, 'role') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
