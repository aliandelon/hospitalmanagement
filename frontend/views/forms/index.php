<?php

use yii\widgets\ListView;
use yii\helpers\Html;

$this->title = "mastermbbs-Forums"
?>

<?= $this->render('_topSubMenu'); ?>
<section class="chapterz">
    <div class="container">
        <div style="float: right;padding-bottom: 10px">
<?= Html::a('Add Question', ['/posts/create'], ['class' => 'btn new-btn btn-success']) ?>

        </div>
        <div class="row">
            <div class="col-md-12">
                <?=
                ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => '_forums',
                    'summary' => '',
                ]);
                ?>
            </div>
        </div>
    </div>
</section>
