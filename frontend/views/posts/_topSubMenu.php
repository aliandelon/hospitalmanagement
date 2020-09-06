<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<section class="mbbs-head">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="atags">
                    <ul>
                        <li class="<?= (Yii::$app->params['active'] == "study") ? 'active' : '' ?>"> <a href="<?= Yii::$app->urlManager->createUrl(['subjects/list-subjects']) ?>">studying</a></li>
                        <li class="<?= (Yii::$app->params['active'] == "test") ? 'active' : '' ?>"> <a href="<?= Yii::$app->urlManager->createUrl(['testpapers']) ?>">tests</a></li>
                        <li class="<?= (Yii::$app->params['active'] == "posts") ? 'active' : '' ?>"> <a href="<?= Yii::$app->urlManager->createUrl(['posts']) ?>">Posts</a> </li>
                        <li class="<?= (Yii::$app->params['active'] == "forums") ? 'active' : '' ?>"> <a href="<?= Yii::$app->urlManager->createUrl(['forms']) ?>">forums</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>