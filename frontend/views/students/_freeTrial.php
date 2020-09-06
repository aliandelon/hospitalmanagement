<?php

use yii\helpers\Url;
?>

<div class="answer">

    <h3>welcome,  <?= $model->first_name ? $model->first_name : "" ?></h3>
    <h6>Your current Plan - <span class="wel"><?= ($currentPlan->plandetails->plan_name) ? $currentPlan->plandetails->plan_name . ' - FREE TRIAL' : 'NIL' ?></span></h6>
    <h4>Plan  Details    :    Free trial will end on <?= ($currentPlan->free_end) ? date('F d, Y',strtotime($currentPlan->free_end)) : 'NIL' ?> </h4>


   <!-- <a href="#" class="sat">Upgrade<img class="del" src="<?= Url::base() . '/images/up.png' ?>"></a> -->
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
        <div class="status-2">

            <button type="submit" class="btn starts btn-default startstudy">start studying</button>

        </div>

    </div>
</div>

