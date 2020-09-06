<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PostCommentsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-comments-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'comment_id') ?>

    <?= $form->field($model, 'comment') ?>

    <?= $form->field($model, 'cb') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'cod') ?>

    <?php // echo $form->field($model, 'post_id') ?>

    <?php // echo $form->field($model, 'field') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
