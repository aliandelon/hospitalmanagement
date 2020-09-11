<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RolesMst */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="roles-mst-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php echo $form->field($model, 'task')->dropDownList([1 => 'Category', 2 => 'Investigations',3=>'Banners',4=>'New Requests',5=>'Active Users']) ?>

    <?= $form->field($model, 'sub_task')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'sort_order')->textInput(['maxlength' => true]) ?>
    <?php echo $form->field($model, 'status')->dropDownList([1 => 'Active', 0 => 'Inactive']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
