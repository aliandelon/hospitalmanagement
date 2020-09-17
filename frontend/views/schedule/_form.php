<?php

use yii\helpers\Html;
//use kartik\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Category;
use yii\helpers\ArrayHelper;
use common\models\Investigations;
use common\models\DoctorsDetails;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Schedule */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="schedule-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->errorSummary($model) ?>

    <?php $form->field($model, 'investigation_id')->textInput()->label('Inestigation');
        $Investigations = Investigations::find()->where('status = 1')->all();
        $listData=ArrayHelper::map($Investigations,'id','investigation_name');
    ?>
    
    <?php echo $form->field($model, 'investigation_id')->widget(Select2::classname(), [
            'data' => $listData,
            'options' => ['placeholder' => 'Select  ...'],
            'pluginOptions' => [
                'tags' => true
            ],
            /*'addon' => [
                'prepend' => [
                    'content' => Html::icon('globe')
                ],
                'append' => [
                    'content' => Html::button(Html::icon('map-marker'), [
                        'class' => 'btn btn-primary', 
                        'title' => 'Mark on map', 
                        'data-toggle' => 'tooltip'
                    ]),
                    'asButton' => true
                ]
            ]*/
        ]); 
    ?>

    <?php 

    $details=DoctorsDetails::find()->where('status = 1 AND  hospital_clinic_id = 2')->all();

    $listData=ArrayHelper::map($details,'id','name');
    echo $form->field($model, 'doctor_id')->dropDownList(
        $listData,
        ['prompt'=>'Select Doctor...']
        )->label('Doctor');
    ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>
    <?php $model->sunday_holiday = true; echo $form->field($model, 'sunday_holiday')->checkbox(['checked' => true]);
    ?>

    <?php
        echo $form->field($model, 'status')->dropDownList(
            ['1' => 'Active', '0' => 'Inactive']
    ); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php $this->registerJs("
    $(document).ready(function() {
        //alert(123);
        
    });
")
?>

