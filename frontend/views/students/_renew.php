<?php

use yii\helpers\Url;
?>

<div class="answer">
    <h3>welcome,  <?= $model->first_name ? $model->first_name : "" ?></h3>
    <h6>Your current Plan - <span class="wel"><?= ($currentPlan->plandetails->plan_name) ? $currentPlan->plandetails->plan_name . ' - Inactive' : 'NIL' ?></span></h6>
   <h4>Mastermbbs shall activate your account with in 24 hours. Please check your email to know about activation.
    In case of any difficulty please contact us at mastermbbslearn@gmail.com 
   
    </h4>



   <!-- <a href="#" class="sat">Upgrade<img class="del" src="<?= Url::base() . '/images/up.png' ?>"></a>-->
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

