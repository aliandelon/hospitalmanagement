<?php foreach ($defaultsubject as $testlist) { ?>
        <div class="panel panel-default">
            <div class="panel-heading startz nw">
                <a   href="<?= \yii\helpers\Url::base() . '/testpapers/take-test?chapterid=' . $testlist['chapter_id'] ?>">   <h4 class="panel-title">
                        <?= ($testlist['chapter_name']) ? $testlist['chapter_name'] : 'Chapter' ?><span class="mans">take the test</span>
                    </h4>
                </a>
            </div>

        </div>
<?php } ?>

