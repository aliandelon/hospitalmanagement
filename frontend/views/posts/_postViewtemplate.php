<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$demoProfilePic = "images/de.jpg";
$profilepicpath = Yii::getAlias('@web') . '/upload/profile/';
?>

<div class="answer">
    <div class="answer-left">
        <img class="ans" src="<?= $model->cb0->profile_image ? $profilepicpath . $model->cb0->profile_image : $demoProfilePic ?>">
        <h2><?= $model->cb0->first_name ? $model->cb0->first_name : "ANONYMOUS" ?> </h2>
        <p><?= $model->cb0->college ? $model->cb0->college : "ANONYMOUS" ?></p>
        <p>1 Year</p>
    </div>
    <div class="answer-right">
        <h1><?= $model->heading ? $model->heading : "NO CONTENT" ?>    </h1>
        <?php
        $content = strip_tags($model->con_text);
        if (strlen($content) > 10) {
                $contentCut = substr($content, 0, 700);
                $content = substr($contentCut, 0, strrpos($contentCut, ' ')) . '... <a href="' . yii::$app->urlManager->createUrl(['posts/detail-post', 'id' => $model->post_id]) . '">Read More</a>';
        }
        ?>

        <p><?= $content ? $content : "NO CONTENT" ?> </p>
        <span class="dates"><?= $model->cod ? date('M  d Y  -  h:i A', strtotime($model->cod)) : "NO CONTENT" ?></span>
    </div>
</div>

<div class="clearfix" style="padding-bottom: 20px"></div>