<?php

use yii\helpers\Url;
?>
<div class="separator">
    <div class="answer-left2">
        <img class="ans img-responsive gg" src="<?= ($model->cb0->profile_image) ? Url::base() . '/profileimages/' . $model->cb0->profile_image : Url::base() . '/images/de.jpg' ?>">
        <h3><?= $model->cb0->first_name . " " . $model->cb0->last_name; ?></h3>
        <span class="dat"><?= ($model->cb0->college) ? $model->cb0->college . ' Year' : ' College Not Set' ?></span><br/>
        <span class="dat"><?= ($model->cb0->mbbs_year) ? $model->cb0->mbbs_year . ' Year' : ' Year Not Set' ?></span>
    </div>
    <div class = "answer-right2">

        <h5><a href="<?= Url::to(['posts/detail-post', 'id' => $model->post_id]); ?>" ><?= ($model->heading) ? $model->heading : "NIL"; ?></a></h5>
        <span class="content">
            <?php
            if (isset($model->con_text)) {
                    $string = strip_tags($model->con_text);
                    if (strlen($string) > 250) {
                            $stringCut = substr($string, 0, 250);

                            $string = substr($stringCut, 0, strrpos($stringCut, ' ')) . '... <a href="' . yii\helpers\Url::base() . '/posts/detail-post?id=' . $model->post_id . '">Read More</a>';
                    }
                    echo $string;
            }
            ?>


            <span class="dates">Posted Today:<?= ($model->cod) ? $model->cod : "NIL"; ?></span>
    </div>
</div>
<div class="clearfix"></div>

