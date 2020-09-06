<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\StudentPlanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-plan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'student_id') ?>

    <?= $form->field($model, 'plan_id') ?>

    <?= $form->field($model, 'cod') ?>

    <?= $form->field($model, 'start_date') ?>

    <?php // echo $form->field($model, 'expiry_date') ?>

    <?php // echo $form->field($model, 'uod') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'free_trial') ?>

    <?php // echo $form->field($model, 'free_start') ?>

    <?php // echo $form->field($model, 'free_end') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
