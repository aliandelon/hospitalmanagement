<?php

use yii\helpers\Url;
?>
<div class="col-md-3 col-sm-12">
    <div class="bg-white">
        <img class="hotdeal" src="<?= Url::base() . '/images/deals.png' ?>">
        <h4><?= ($model->plan_name) ? $model->plan_name : "NIL" ?></h4>
        <div class="whites">
            <!--  <h2>Starting at</h2>-->
            <nav class="cl-effect-6">
             <a class="price" href="javascript:void(0)"><span data-hover="Free Trial">FREE TRIAL</span></a>
               <!--<a class="price" href="#"><span data-hover="00.00 $"><?= (($model->price) && $model->price > 0 ) ? 'rs' . $model->price : "rs. 0.00" ?></span></a>-->
            </nav>
            <!--  <h2>Per Month</h2>-->
        </div>
        <p>more than 100 videos</p>
        <p>Quality asured</p>
        <a class="chose" href="<?= Url::base() . '/student-plan/choose-plan?id=' . $model->plan_id ?>">Start Now</a>
    </div>
</div>