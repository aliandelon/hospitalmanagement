<?php

use yii\helpers\Url;

$this->title = "mastermbbs-myPlan";
?>
<section class="mbbs-answer">
    <div class="container">
        <div class="row">
            <?= $this->render('_menuLinks') ?>
            <div class="col-md-8 col-sm-12 col-xs-12 ">
                <div class="answer-main">
                    <?php
                    /* if ($currentPlan->free_trial == 1 && date('Y-m-d', strtotime($currentPlan->free_end)) >= date('Y-m-d')) {
                      echo $this->render('_freeTrial', ['model' => $model, 'currentPlan' => $currentPlan]);
                      } elseif ($currentPlan->status == 1 && date('Y-m-d', strtotime($currentPlan->expiry_date) < date('Y-m-d'))) {
                      echo $this->render('_course', ['model' => $model, 'currentPlan' => $currentPlan]);
                      } else {
                      echo $this->render('_renew', ['model' => $model, 'currentPlan' => $currentPlan]);
                      } */
                    ?>


                    <div class="answer">
                        <h6>Your current Plan - <span class="wel"><?= ($currentPlan->plandetails->plan_name) ? $currentPlan->plandetails->plan_name : 'NIL' ?></span></h6>
                        <h4>Plan Details    :    12 hours left of <?= ($currentPlan->plandetails->periods) ? $currentPlan->plandetails->periods : 'NIL' ?> days</h4>


                        <a href="#" class="sat">Upgrade<img class="del" src="<?= Url::base() . '/images/up.png' ?>"></a>
                        <div class="clearfix"></div>
                        <div class="status">
                            <div class="status-1">
                                <div class="zeros">

                                    <div class="copyz">
                                        <div class="col-sm-3 col-xs-3 zeros">
                                            <label for="textinput" class="control-labelz">First Name	</label>
                                        </div>
                                        <div class="col-sm-1 col-xs-1 zeros">
                                            <label for="textinput" class="control-labelz">:</label>
                                        </div>
                                        <div class="col-sm-8 col-xs-8 zeros">
                                            <label for="textinput" class="control-labelz"> <?= $model->first_name ? $model->first_name : "" ?></label>
                                        </div>
                                    </div>

                                    <div class="copyz">
                                        <div class="col-sm-3 col-xs-3 zeros">
                                            <label for="textinput" class="control-labelz">Last Name</label>
                                        </div>
                                        <div class="col-sm-1 col-xs-1 zeros">
                                            <label for="textinput" class="control-labelz">:</label>
                                        </div>
                                        <div class="col-sm-8 col-xs-8 zeros">
                                            <label for="textinput" class="control-labelz"><?= $model->last_name ? $model->last_name : "" ?></label>
                                        </div>
                                    </div>


                                    <div class="copyz">
                                        <div class="col-sm-3 col-xs-3 zeros">
                                            <label for="textinput" class="control-labelz">Email	</label>
                                        </div>
                                        <div class="col-sm-1 col-xs-1 zeros">
                                            <label for="textinput" class="control-labelz">:</label>
                                        </div>
                                        <div class="col-sm-8 col-xs-8 zeros">
                                            <label for="textinput" class="control-labelz"><?= $model->user_id ? $model->user_id : "" ?></label>
                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>