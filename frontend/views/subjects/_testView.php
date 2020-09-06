<div class="col-md-9 col-sm-12 col-xs-12 primes">
    <div class="sixty">
        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <? foreach($defaultsubject as $chapter){ ?>
                <div class="panel-heading">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $chapter['chapter_id'] ?>">   <h4 class="panel-title">
                            <?= $chapter['chapter_name'] ? $chapter['chapter_name'] : ""; ?>
                            <span class="mans">take the test<i class="fa rights fa-angle-right"></i></span>
                        </h4>
                    </a>
                </div>
                <div id="collapse<?= $chapter['chapter_id'] ?>" class="panel-collapse collapse">
                    <div class="panel-body ss">
                        <? $topics = \frontend\models\Posts::getTests($chapter['chapter_id']);
                        $i=1;
                        foreach($topics as $tkey){?>
                        <div class="subjects">
                            <?= $i . ") " ?>
                            <a href="<?= yii::$app->urlManager->createUrl(['subjects/start-test', 'chapterid' => $tkey['chapter_id'], 'test_id' => $tkey['test_id']]) ?>"><?= $tkey['test_name'] ?></a>
                        </div>

                        <? $i++;}?>
                    </div>
                </div>

                <?}?>
            </div>
        </div>
    </div>
</div>