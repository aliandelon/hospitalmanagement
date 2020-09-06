<?php

use yii\widgets\ListView;
?>

<section class="packages">
    <div class="container">
        <div class="row">
            <?=
            ListView::widget([
                'dataProvider' => $plans->getPlans(),
                'itemView' => '_plansViews',
                'summary' => '',
            ]);
            ?>
        </div>
    </div>
</section>