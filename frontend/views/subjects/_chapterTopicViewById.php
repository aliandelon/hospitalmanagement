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
$videoPath = dirname(Yii::$app->basePath) . '/common/uploads/';
if (isset($topicView) && $topicView > 0) {
        $topicDetails = backend\models\Topics::find()->where(['topic_id' => $topicView])->one();
        ?>
        <div class="col-md-9">
            <div class="row">

                <div class="col-md-7">
                    <h1><?= $topicDetails->topic ?></h1>

                    <video width="481" height="300" controls>
                        <source src="<?= $videoPath . $topicDetails->video_file ? $topicDetails->video_file : "" ?>" type="video/mp4">
                        <source src="<?= $videoPath . $topicDetails->video_file ? $topicDetails->video_file : "" ?>" type="video/ogg">
                        Your browser does not support the video tag.
                    </video>
                    <p> <?= $topicDetails->content; ?></p>
                </div>
                <div class="col-md-5">
                    <div class="answerk">
                        <h6>Related Posts</h6>
                        <?=
                        ListView::widget([
                            'dataProvider' => new ActiveDataProvider([
                                'query' => frontend\models\Posts::find()->where(['topic_id' => $topicDetails->topic_id]),
                                    ]),
                            'summary' => FALSE,
                            'options' => [
                                //'tag' => 'div',
                                //'class' => 'list-wrapper',
                                'id' => 'list-wrapper',
                                'pagination' => [
                                    'pageSize' => 2,
                                    'route' => '',
                                ],
                            ],
                            'itemView' => '_relatedTopicView',
                        ]);
                        ?>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <? } else{ ?>
        <div class="col-md-9">
            <div class="row">
                <span>Requested page not found</span>
            </div>
        </div>
<?php
}?>