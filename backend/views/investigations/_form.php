<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Category;
/* @var $this yii\web\View */
/* @var $model common\models\Investigations */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="investigations-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php 
    $categories=Category::find()->all();

    $listData=ArrayHelper::map($categories,'id','category_name');
    echo $form->field($model, 'mst_id')->dropDownList(
        $listData,
        ['prompt'=>'Select...']
        )->label('Category');
    ?>
    <?= $form->field($model, 'investigation_name')->textInput(['maxlength' => true]) ?>

    <?php
        echo $form->field($model, 'status')->dropDownList(
            ['1' => 'Active', '0' => 'Inactive']
    ); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
