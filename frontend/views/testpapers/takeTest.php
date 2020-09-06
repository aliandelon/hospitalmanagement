<?php

use yii\widgets\ListView; ?>

<?= $this->render('_topSubMenu'); ?>

<section class="mbbs-test">
    <div class="container">

        <div class="row">
            <div class="col-md-3">

            </div>
            <div class="col-md-9 zeros timerz">
                <h6 id="chapter-heading">Chapter-<?= $chapterDetails['chapter_name'] ?></h6>
                <div id="defaultCountdown"></div>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 test">
                <div class="mbbs-left">
                    <ul>
                        <?php foreach ($chapters as $chapters) { ?>
                                <li><a href="<?= yii\helpers\Url::base() . '/testpapers/take-test?chapterid=' . $chapters->chapter_id ?>"><?= $chapters->chapter_name ?></a></li>


                        <?php } ?>
                    </ul>

                </div>

            </div>

            <div class="col-md-9 col-sm-12 col-xs-12 primes newlist">

                <?=
                ListView::widget([
                    'dataProvider' => $model->loadTestQuestions(),
                    'itemView' => '_test',
                    'summary' => '',
                    'pager' => [

                        'prevPageLabel' => '<button type = "submit" class = "btn test1 btn-default">Back</button>',
                        'nextPageLabel' => '<button type = "submit" class = "btn test2 btn-default">Skip</button>',
                        'maxButtonCount' => 0,
                    ],
                ]);
                ?>



            </div>
        </div>
    </div>
</section>
