<?= $this->render('_topSubMenu');
?>
<section class="chapterz">
    <div class="container">
        <div class="row">
            <div class="col-md-3 bullets">
                <div class="panel-group" id="accordion">
                    <?
                    foreach($chapters as $chap) {?>
                    <div class="panel panel-default">
                        <div class="panel-heading c1">
                            <div class="cir"></div>
                            <h4 class="panel-title">
                                <a class="accordion-toggle plus" data-toggle="collapse" data-parent="#accordion" href="#panel1" aria-expanded="true"><i class="glyphicon glyphicon-minus"></i><?= $chap['chapter_name'] ?></a>
                            </h4>

                        </div>
                        <div id="panel1" class="panel-collapse collapse in" aria-expanded="true">
                            <div class="panel-body">
                                <ul>

                                    <?$topics = \frontend\models\Posts::getTopics($chap['chapter_id']);
                                    foreach($topics as $tkey){?>
                                    <li><a href="#" class="chaptertopichref" id=topic-<?= $tkey['topic_id'] ?>><?= $tkey['topic'] ?></a></li>
                                    <?}
                                    ?>

                                </ul>
                            </div>
                        </div>
                    </div>

                    <? }
                    ?>


                </div>
            </div>
            <div id="topicViewById-div">
                <?= $this->render('_chapterTopicViewById', ['topicView' => $topicView]); ?>
            </div>
        </div>
    </div>
</section>