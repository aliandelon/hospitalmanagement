<div class="forums">
    <a href="<?= yii\helpers\Url::base() . '/forms/question-details?id=' . $model->id ?>">
        <span class="sub-title"><?= ($model->title) ? $model->title : "" ?> </span></a>
    <p>
        <?php
        if (isset($model->content)) {
                $string = strip_tags($model->content);
                if (strlen($string) > 500) {
                        $stringCut = substr($string, 0, 500);

                        $string = substr($stringCut, 0, strrpos($stringCut, ' ')) . '... <a href="' . yii\helpers\Url::base() . '/fourms/question-details?id=' . $model->id . '">Join Discussion</a>';
                }
                echo $string;
        }
        ?>

    </p>
</div>
<div class="clearfix" style="padding-bottom: 30px"></div>
