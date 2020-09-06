<?php

use yii\helpers\Url;
?>

<div class="col-md-4 mbb">
    <div class="mbbs-left">
        <img class="center-block demo" src="<?= Url::base() . '/images/demo.jpg' ?>">
        <ul>
            <!--   <li><a href="#">Study</a></li>-->
            <!--<li><a href="#">bookmarks</a></li>-->
            <!--  <li><a href="#">Posts</a></li>-->
            <li><a href="#">Questions</a></li>
            <li><a href="<?= yii::$app->urlManager->createUrl(['posts/latest-post']) ?>">Latest post</a></li>
            <li><a href="#">Plan Details</a></li>

            <li class="active"><a href="<?= yii::$app->urlManager->createUrl(['students/update']) ?>">Edit profile</a></li>
        </ul>
    </div>
</div>