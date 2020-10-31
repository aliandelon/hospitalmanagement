<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\DoctorsDetails */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="doctors-details-form">
    <div class="row">
        <div class="col-lg-12">
            <?php  $form = ActiveForm::begin(
                    ['options' => ['enctype' => 'multipart/form-data']], [
                'fieldConfig' => [
                    'options' => [
                        'tag' => false,
                    ],
                ],
            ]); ?>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Name <span class="text-danger">*</span></label>
                            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Email <span class="text-danger">*</span></label>
                           <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Contact <span class="text-danger">*</span></label>
                           <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Licence No</label>
                            <?= $form->field($model, 'registration_no')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Experience</label>
                            <?= $form->field($model, 'experience')->textInput() ?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Upload Photo:</label>
                            <div class="profile-upload">
                                <div class="upload-img">
                                    <?php if($model->profile_image){?>
                                        <img alt="" src="<?php echo Yii::$app->request->baseUrl . '/uploads/doctors/'.$model->id.'/'.$model->id.'.'. $model->profile_image?>" width="60px">
                                    <?php }else{?>
                                        <i class="fa fa-user-md fa-2x"></i>
                                    <?php } ?>
                                </div>
                                <div class="upload-input">
                                    <input type="file" name="DoctorsDetails[profile_image]" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Specialization</label>
                                <?= $form->field($model, 'specialty_id')->dropDownList(yii\helpers\ArrayHelper::map(common\models\DoctorSpecialtyMst::find()->where(['status' => 1])->all(), 'id', 'name'), ['prompt' => 'Select Doctor Speciality']) ?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group gender-select">
                            <label class="gen-label">Gender:</label>
                            <?= $form->field($model, 'gender')->radioList(array('M'=>'Male','F'=>'Female')); ?>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Qualification</label>
                                    <?= $form->field($model, 'qualifications')->textInput(['maxlength' => true]) ?>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <?php echo $form->field($model, 'status')->dropDownList(
                                    ['1' => 'Active', '0' => 'Deactive']
                                    ); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-t-20 text-center">
                    <button class="btn btn-primary submit-btn">Save</button>
                    <a class="btn btn-danger cancel-btn" href="<?php echo Yii::$app->request->baseUrl .'/doctors-details/'?>">Cancel</a>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<style>
    .control-label{
        display:none;
    }
    .cancel-btn{
        border-radius: 50px;
        color: #fff;
        font-size: 16px;
        font-weight: 500;
        min-width: 200px;
        padding: 8px 20px;
        text-transform: uppercase;
    }
</style>