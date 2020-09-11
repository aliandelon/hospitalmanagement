<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
/* @var $this yii\web\View */
/* @var $model common\models\AdminDetails */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-details-form">

        <?php
    $form = ActiveForm::begin(
                    ['options' => ['enctype' => 'multipart/form-data']], [
                'fieldConfig' => [
                    'options' => [
                        'tag' => false,
                    ],
                ],
    ]);
    ?>

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
     <?=
    $form->field($model, 'profile_image')->widget(FileInput::classname(), [
          'pluginOptions' => ['previewFileType' => 'any',
         'allowedFileExtensions' => ['jpg', 'png', 'bmp', 'tiff'],
         'maxFileSize' => 300,
            'options' => ['accept' => 'image/*']],
    ]);
    ?>
    
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <?php
            if ($model->profile_image != '' && $model->id != "" && $model->profile_image != 0) {

                echo '<img width="125" style="border: 2px solid #d2d2d2;margin-right:.5em;" src="' . Yii::$app->request->baseUrl . '/../uploads/admin-details/' . $model->id . '/' . $model->id . '.' . $model->profile_image . '" />'
                ?>
                <br>
                <br>
            <?php }
            ?>

        </div>
    </div>
    <?php
        echo $form->field($model, 'status')->dropDownList(
            ['1' => 'Active', '0' => 'Inactive']
    ); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
