<?php

use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 *
 *
 */
if (isset($topicView) && $topicView > 0) {
        $topicDetails = backend\models\Question::find()->where(['test_id' => yii::$app->session->get('currenttest')])->one();
        ?>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-7">
                    <h1><?= yii::$app->session->get('currenttest') ?></h1>


                </div>
                <
            </div>
        </div>
        <? } else{ ?>
        <div class="col-md-9">
            <div class="row">
                <span>Requested page not found</span>
            </div>
        </div>
<?php } ?>