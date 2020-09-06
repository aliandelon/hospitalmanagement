<?php

use yii\helpers\Url;
?>
<div class="panel-body ss">
    <div class="subjects">
        <a href="<?= Url::base() . '/chapters/list-chapters?chapterid=' . $model->chapter_id . "&topicid=" . $model->topic_id ?>">
            <?= $model->topic; ?></a>
    </div>

</div>

