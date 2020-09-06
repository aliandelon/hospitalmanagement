<?php

use yii\widgets\ListView;

$this->title = "mastermbbs";
?>

<section class="mbbs-answer">
    <div class="container">
        <div class="row">
            <?= $this->render('_menuLinks', ['model' => $model]) ?>
            <div class="col-md-8 col-sm-12 col-xs-12 ">
                <div class="answer-main">
                    <?php
                    if ($currentPlan->free_trial == 1 && date('Y-m-d', strtotime($currentPlan->free_end)) >= date('Y-m-d')) {
                            echo $this->render('_freeTrial', ['model' => $model, 'currentPlan' => $currentPlan]);
                    } elseif ($currentPlan->status == 1 && date('Y-m-d', strtotime($currentPlan->expiry_date) < date('Y-m-d'))) {
                            echo $this->render('_course', ['model' => $model, 'currentPlan' => $currentPlan]);
                    } else {
                            echo $this->render('_renew', ['model' => $model, 'currentPlan' => $currentPlan]);
                    }

                    /* echo ListView::widget([
                      'dataProvider' => $model->loadPost(),
                      'itemView' => '_postView',
                      'summary' => '',
                      ]); */
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

