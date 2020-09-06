<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\StudentPlan */
/* @var $form yii\widgets\ActiveForm */
?>

<section class="packages hidden-xs">
        <div class="container">
                <div class="row">

                        <nav class="cl-effect-5">
                                <a href="#"><span data-hover="Featured Packages">Featured Packages</span></a>
                        </nav>
                        <img class="center-block dots" src="<?= Yii::$app->request->baseUrl . '/images/dots.png' ?>">

                        <?php
                        foreach ($allplans as $plans) {
                                ?>
                                <div class="col-md-3 col-sm-12">
                                        <div class="bg-white">
                                                <img class="hotdeal" src="../images/deals.png">
                                                <h4>Standard</h4>
                                                <div class="whites">
                                                        <!-- <h2>Starting at</h2> -->
                                                        <nav class="cl-effect-6">
                                                                <a class="price" href="#"><span data-hover="<?php echo 'INR '.$plans->price ?>">INR<?php echo $plans->price . ' '; ?></span></a>
                                                        </nav>
                                                        <h2>Per Year</h2>
                                                </div>
                                                <?php /*  <p><?php echo $plans->remarks; ?></p>
                                                  <p><?php echo $plans->highlight; ?></p>
                                                  <p><?php echo $plans->includes; ?></p> */ ?>
                                                <p><?= ($plans->remarks) ? $plans->remarks : 'NA' ?></p>
                                                <p><?= ($plans->highlight) ? $plans->highlight : 'NA'; ?></p>
                                                <p><?= ($plans->includes) ? $plans->includes : 'NA'; ?></p>

                                                <a class="chose" href="<?= Yii::$app->request->baseUrl . '/student-plan/plan-details?id=' . $id . '&plan_id=' . $plans->plan_id ?>">Choose Now</a>
                                        </div>
                                </div>
                                <?php
                        }
                        ?>






                </div>
        </div>
</section>