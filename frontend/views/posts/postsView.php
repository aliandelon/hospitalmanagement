<?php

use yii\widgets\ListView;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?= $this->render('_topSubMenu'); ?>
<section class="mbbs-answer">
    <div class="container">
        <div class="row">
            <?= $this->render('_postMenuLinks') ?>
            <div class="col-md-8 col-sm-12 col-xs-12 ">
                <br>
                <h6>Recent Posts</h6>
                <div class="answer-main">
                    <?=
                    ListView::widget([
                        'dataProvider' => $provider,
                        'itemView' => '_postViewtemplate',
                        'summary' => '',
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

