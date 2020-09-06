<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TestpapersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="testpapers-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'test_id') ?>

    <?= $form->field($model, 'test_name') ?>

    <?= $form->field($model, 'chapter_id') ?>

    <?= $form->field($model, 'cb') ?>

    <?= $form->field($model, 'ub') ?>

    <?php // echo $form->field($model, 'cod') ?>

    <?php // echo $form->field($model, 'uod') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'field') ?>

    <?php // echo $form->field($model, 'field2') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
