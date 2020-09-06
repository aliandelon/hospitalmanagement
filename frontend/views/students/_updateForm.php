<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
?>


<h2>Edit Profile</h2>
<a href="<?= yii::$app->urlManager->createUrl(['students/my-profile']) ?>" class="myprofiles"><img class="users" src="<?= yii\helpers\Url::base() . '/images/user.jpg' ?>">my profile</a>
<?php $form = ActiveForm::begin(); ?>
<div class="zeros">
    <div class="common">
        <div class="col-sm-3 col-xs-3 zeros">
            <label for="textinput" class="control-label">First Name</label>
        </div>
        <div class="col-sm-1 col-xs-1 zeros">
            <label for="textinput" class="control-label">:</label>
        </div>
        <div class="col-sm-8 col-xs-8 zeros">
            <div class="form-group">
                <?= $form->field($model, 'first_name')->textInput(['maxlength' => true, 'class' => 'ui_apps'])->label(FALSE) ?>
            </div>
        </div>
    </div>



    <div class="common">
        <div class="col-sm-3 col-xs-3 zeros">
            <label for="textinput" class="control-label">Last Name</label>
        </div>
        <div class="col-sm-1 col-xs-1 zeros">
            <label for="textinput" class="control-label">:</label>
        </div>
        <div class="col-sm-8 col-xs-8 zeros">
            <div class="form-group">
                <?= $form->field($model, 'last_name')->textInput(['class' => 'ui_apps', 'maxlength' => true])->label(FALSE) ?>
            </div>
        </div>
    </div>


    <div class="common">
        <div class="col-sm-3 col-xs-3 zeros">
            <label for="textinput" class="control-label">Parent Email</label>
        </div>
        <div class="col-sm-1 col-xs-1 zeros">
            <label for="textinput" class="control-label">:</label>
        </div>
        <div class="col-sm-8 col-xs-8 zeros">
            <div class="form-group">
                <?= $form->field($model, 'parent_email')->textInput(['class' => 'ui_apps', 'maxlength' => true])->label(FALSE) ?>
            </div>
        </div>
    </div>



    <div class="common">
        <div class="col-sm-3 col-xs-3 zeros">
            <label for="textinput" class="control-label">College</label>
        </div>
        <div class="col-sm-1 col-xs-1 zeros">
            <label for="textinput" class="control-label">:</label>
        </div>
        <div class="col-sm-8 col-xs-8 zeros">
            <div class="form-group">
                <?= $form->field($model, 'college')->textInput(['maxlength' => true, 'class' => 'ui_apps'])->label(FALSE) ?>
            </div>
        </div>
    </div>


    <div class="common">
        <div class="col-sm-3 col-xs-3 zeros">
            <label for="textinput" class="control-label">Year</label>
        </div>
        <div class="col-sm-1 col-xs-1 zeros">
            <label for="textinput" class="control-label">:</label>
        </div>
        <div class="col-sm-8 col-xs-8 zeros">
            <div class="form-group">
                <?= $form->field($model, 'mbbs_year')->textInput(['maxlength' => true, 'class' => 'ui_apps'])->label(FALSE) ?>
            </div>
        </div>
    </div>


    <div class="common">
        <div class="col-sm-3 col-xs-3 zeros">
            <label for="textinput" class="control-label">Address</label>
        </div>
        <div class="col-sm-1 col-xs-1 zeros">
            <label for="textinput" class="control-label">:</label>
        </div>
        <div class="col-sm-8 col-xs-8 zeros">
            <div class="form-group">
                <?= $form->field($model, 'address')->textArea(['rows' => 5, 'class' => 'form-address'])->label(false) ?>
            </div>
        </div>
    </div>


    <div class="common">
        <div class="col-sm-3 col-xs-3 zeros">
            <label for="textinput" class="control-label">Profile Image</label>
        </div>
        <div class="col-sm-1 col-xs-1 zeros">
            <label for="textinput" class="control-label">:</label>
        </div>
        <div class="col-sm-8 col-xs-8 zeros">
            <div class="form-group">
                <?=
                $form->field($model, 'profile_image')->widget(FileInput::classname(), [
                    'pluginOptions' => ['previewFileType' => 'any'],
                ])->label(FALSE);
                ?>
            </div>
        </div>
    </div>



    <div class="common tops">
        <div class="col-sm-4 col-xs-4 zeros">
            <?= Html::submitButton('Update', ['class' => 'btn sub-btn btn-default']) ?>

        </div>
    </div>
</div>
</div>
<?php ActiveForm::end(); ?>