<div class="forums">
    <a href="<?= yii\helpers\Url::base() . '/posts/detail-post?id=' . $model->post_id ?>">
        <span class="sub-title"><?= ($model->heading) ? $model->heading : "" ?> </span></a>
    <p>
        <?php
        if (isset($model->con_text)) {
                $string = strip_tags($model->con_text);
                if (strlen($string) > 500) {
                        $stringCut = substr($string, 0, 500);

                        $string = substr($stringCut, 0, strrpos($stringCut, ' ')) . '... <a href="' . yii\helpers\Url::base() . '/posts/detail-post?id=' . $model->post_id . '">Read More</a>';
                }
                echo $string;
        }
        ?>

    </p>
</div>
<div class="clearfix" style="padding-bottom: 20px"></div>
