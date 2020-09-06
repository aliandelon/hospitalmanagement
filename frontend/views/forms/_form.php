<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model frontend\models\Posts */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
$sub = \yii\helpers\ArrayHelper::map(backend\models\Subjects::find()->all(), 'sub_id', 'sub_name');
$top = \yii\helpers\ArrayHelper::map(backend\models\Topics::find()->all(), 'topic_id', 'topic');
?>
<?php $form = ActiveForm::begin(['id' => 'post-form', 'options' => ['role' => 'form']]); ?>
<div class="row">
    <?php if (Yii::$app->session->hasFlash('formsuccess')): ?>
            <div class="info">
                <?php echo Yii::$app->session->getFlash('postsuccess'); ?>
            </div>
    <?php endif; ?>
    <div class="col-md-6">
        <h6><?= $this->title ?></h6>
        <div class="form-group">
            <?= $form->field($model, 'sub_id')->dropDownList($sub, ['class' => 'aps', 'carform' => 'carform', 'prompt' => 'Select Semester']) ?>
        </div>
        <div class="form-group">
            <?= $form->field($model, 'topic_id')->dropDownList($top, ['class' => 'aps', 'carform' => 'carform', 'prompt' => 'Select Semester']) ?>
        </div>
        <div class="form-group">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'class' => 'ui_ques'])->label('Title', ['class' => 'questions']) ?>
        </div>
    </div>

    <div class="col-md-6">
        <div class="ins">
            <h6>Instructions to Add a Question</h6>
            <p>Only the best and perfect articles will be allowed to be published that meet the following requirements </p>
            <ul>
                <li>post should have relevant and genuine information and content.</li>
                <li>post is published in a relevant topic.</li>
                <li>post that seem like an advertisement or selling proposition would be deleted.    </li>

            </ul>
            <p>We reserve the right to decide if any article is fit for publishing and take necessary action and delete if necessary without any notification. </p>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <?=
            $form->field($model, 'content')->widget(CKEditor::className(), [
                'options' => ['rows' => 5, 'class' => 'form-controlv'],
                'preset' => 'basic'
            ])->label('Content', ['class' => 'questions'])
            ?>

        </div>
        <div class="form-group">
            <?= $form->field($model, 'serach_tags')->textInput(['class' => 'ui_ques'])->label('Search tags', ['class' => 'questions']) ?>
        </div>
        <!-- <div class="sear"></div>-->
        <?= Html::submitButton($model->isNewRecord ? 'Submit' : 'Update', ['class' => 'btn qued btn-default']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>