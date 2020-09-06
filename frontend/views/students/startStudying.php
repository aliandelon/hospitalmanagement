<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<section class="search_form">
    <div class="container">
        <div class="row">
            <div class="hidden-xs col-sm-4">

            </div>

            <div class="col-md-4 col-sm-4">
                <h2>Start Studying</h2>
                <h6>Choose</h6>
                <div class="form-group">
                    <?php
                    $year = \yii\helpers\ArrayHelper::map(backend\models\Years::find(['status' => 1])->all(), 'year_id', 'year_name');
                    if (isset($model->year) && $model->year > 0) {
                            $sem = \yii\helpers\ArrayHelper::map(backend\models\Semesters::find(['status' => 1, 'year_id' => $model->year])->all(), 'sem_id', 'sem_name');
                    } else {
                            $sem = [];
                    }

                    $form = ActiveForm::begin(['id' => 'studying-form', 'options' => ['role' => 'form']]);
                    ?>

                    <div class="form-group">
                        <?= $form->field($model, 'year')->dropdownlist($year, ['class' => 'aps', 'prompt' => 'Select Year'])->label(false) ?>
                    </div>
                    <div class="form-group">
                        <?= $form->field($model, 'sem')->dropdownlist($sem, ['class' => 'aps', 'prompt' => 'Select Sem'])->label(false) ?>
                    </div>

                    <?= Html::submitButton('GO', ['class' => 'btn new-btn btn-default', 'name' => 'study-button']) ?>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
</section>