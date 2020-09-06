<?php

use yii\widgets\ListView;
use yii\helpers\Html;
?>

<?= $this->render('_topSubMenu'); ?>
<section class="chapterz">
    <div class="container">
        <div style="float: right;padding-bottom: 10px">
            <?= Html::a('Add Post', ['/posts/create'], ['class' => 'btn new-btn btn-success']) ?>

        </div>
        <div class="row">
            <div class="col-md-12">
                <?=
                ListView::widget([
                    'dataProvider' => $model->loadMyPost(),
                    'itemView' => '_posts',
                    'summary' => '',
                ]);
                ?>
            </div>
        </div>
    </div>
</section>
