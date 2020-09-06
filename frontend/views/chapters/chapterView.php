<?= $this->render('_topSubMenu'); ?>

<section class="chapterz">
    <div class="container">
        <div class="row">
            <div class="col-md-3 bullets">
				<div class="mob-topics">
                                       					
					<div class="topic_links"><a href="#topics" class="ion-navicon-round"><span>TOPICS</span></a></div>
					<div class="topic_lists">
 <div class="mClose">X</div>
						<div class="panel-group" id="accordion">
                    <?php
                    for ($i = 0; $i < count($chapters); $i++) {
                            ?>
                            <div class="panel panel-default">
                                <div class="panel-heading c1">
                                    <div class="cir"></div>
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle plus chapter_link <?= (Yii::$app->params['accordion'] == 'a_panel_' . $chapters[$i]['chapter_id']) ? '' : 'collapsed' ?>" data-toggle="collapse" data-parent="#accordion" href="#panel_<?= $chapters[$i]['chapter_id'] ?>" aria-expanded="true"><i class="glyphicon glyphicon-<?= (Yii::$app->params['accordion'] == 'a_panel_' . $chapters[$i]['chapter_id']) ? 'minus' : 'plus' ?>"></i><?= $chapters[$i]['chapter_name'] ?></a>
                                    </h4>

                                </div>
                                <div id="panel_<?= $chapters[$i]['chapter_id'] ?>" class="panel-collapse collapse <?= ((Yii::$app->params['accordion'] == 'a_panel_' . $chapters[$i]['chapter_id'])) ? 'in' : '' ?>" aria-expanded="<?= ($i < 1) ? 'true' : 'false' ?>">
                                    <div class="panel-body">
                                        <ul>
                                            <?php
                                            $chapaterTopics = $model->loadTopics($chapters[$i]['chapter_id']);
                                            foreach ($chapaterTopics as $chapaterTopics) {
                                                    ?>
                                                    <li><a href="<?= $chapaterTopics->topic ?>" id="topic_video_<?= $chapaterTopics->topic_id ?>" class="topic_video_link" ><?= $chapaterTopics->topic ?> </a></li>
                                            <?php } ?>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                    <?php } ?>


                </div>
					</div>
				</div>
				
                
                
            </div>
            <div class="col-md-9" id="topicDetails">

                <?= $this->render('_topicVideoView', ['topicDetails' => $topicDetails, 'posts' => $posts]) ?>
            </div>
        </div>
    </div>
</section>

<?php
$this->registerJs("
$('.panel .accordion-toggle').click(function(){
        $('.panel .accordion-toggle').find('i.glyphicon').removeClass('glyphicon-minus');
        $('.panel .accordion-toggle').find('i.glyphicon').addClass('glyphicon-plus');
        if(!$(this).hasClass('collapsed')){
        $(this).find('i.glyphicon').removeClass('glyphicon-minus');
        $(this).find('i.glyphicon').addClass('glyphicon-plus');
        }
        else{
        $(this).find('i.glyphicon').addClass('glyphicon-minus');
        $(this).find('i.glyphicon').removeClass('glyphicon-plus');
        }
});

");
