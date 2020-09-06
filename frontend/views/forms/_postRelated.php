<?php

use yii\helpers\Url;
?>

<div class="separator">
    <div class="answer-left2">
        <img class="ans img-responsive gg" src="<?= ($model->cb0->profile_image) ? Url::base() . '/profileimages/' . $model->cb0->profile_image : Url::base() . '/images/de.jpg' ?>">
        <h3><?= $model->cb0->first_name ? $model->cb0->first_name : "" ?></h3>
        <span class="dat"><?= $model->cb0->college ? $model->cb0->college : "College-Not Set" ?></span>
        <span class="dat"><?= $model->cb0->mbbs_year ? $model->cb0->mbbs_year : "Year-Not Set" ?></span>
    </div>
    <div class="answer-right2">
        <span class="content"><?= $model->con_text ? $model->con_text : "NO CONTENT" ?> </span>
        <span class="dates">Posted <?= $model->cod ? $model->cod : "NO CONTENT" ?></span>
    </div>
</div>
<div class="clearfix"></div>