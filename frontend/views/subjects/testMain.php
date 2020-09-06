<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?= $this->render('_topSubMenu');
?>
<section class="chapterz">
    <div class="container">
        <div class="row">
            <div class="col-md-3 bullets">
                <div class="panel-group" id="accordion">

                    <?$testList = \frontend\models\Posts::getTests(yii::$app->session->get('currentchapter'));
                    foreach($testList as $test) {?>
                    <div class="panel panel-default">
                        <div class="panel-heading c1">
                            <div class="cir"></div>
                            <h4 class="panel-title">
                                <a class="accordion-toggle plus" data-toggle="collapse" data-parent="#accordion" href="#panel1" aria-expanded="true"><?= $test['test_name'] ?></a>
                            </h4>
                        </div>
                    </div>

                    <? }
                    ?>
                </div>
            </div>
            <div id="topicViewById-div">
                <?= $this->render('_chapterTestViewById', ['testView' => yii::$app->session->get('currenttest')]); ?>
            </div>
        </div>
    </div>
</section>