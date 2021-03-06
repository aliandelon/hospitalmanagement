<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\RolesMst;
/* @var $this yii\web\View */
/* @var $model common\models\UserRolesMapping */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-roles-mapping-form">

    <?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'user_id')->dropDownList(yii\helpers\ArrayHelper::map(common\models\AdminDetails::find()->where(['status' => 1])->andFilterWhere(['=', 'role_id', '1'])->all(), 'admin_id', 'name'), ['prompt' => 'Select Sub Super Admin']) ?>
        <?php if(!empty($tasks)){?>
            <div class="row">
                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                    <label class="control-label" for="roles_id">Roles</label>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                    <label><input type="checkbox" value="" id="selectall"> <i></i>Select All</label>
                </div>
             </div>
          <div class="row">

            <?php $taskArr = [1 => 'Category', 2 => 'Investigations',3=>'Banners',4=>'New Requests',5=>'Active Users']; ?>
            <?php foreach($tasks as $tsks){ ?>
                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12" style="min-height: 200px; !important;">
                    <div class="i-checks ">
                        <label>
    <input type="checkbox" value="<?=$tsks->task?>" name="UserRolesMapping[role_main_id][]" class="<?='checkboxall main main'.$tsks->task?>">
     <i></i><?=($tsks->task) ? $taskArr[$tsks->task]:''?> 
                        </label>
                    </div>
                    <?php 
                    $subtasks=RolesMst::find()->where(['task'=>$tsks->task])->orderBy(['sort_order' => SORT_ASC])->All();
                    if(!empty($subtasks)){
                        foreach ($subtasks as $subtask) {
                        $chName="UserRolesMapping[role_id][".$tsks->task."][]";
                    ?>
                      <div class="i-checks ">
                        <label>
                    <input type="checkbox" name=<?=$chName?> class="<?='checkboxall individual-check individual'.$tsks->task?>" value="<?=$subtask->id?>"> <i></i><?=($subtask->sub_task)?$subtask->sub_task:""?>
                        </label>
                    </div>
                    <?php
                         }
                     }?>
                    
                </div>
            <?php } ?>
               
            </div>
        <?php } ?>
    <?php
        echo $form->field($model, 'status')->dropDownList(
            ['1' => 'Active', '0' => 'Inactive']
    ); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>



<?php

$this->registerJs("
    $(document).ready(function(){
    $('#selectall').click(function(){
        if(this.checked){
                $('.checkboxall').each(function(){
                    $('.checkboxall').prop('checked', true);
                })
            }else{
                $('.checkboxall').each(function(){
                    $('.checkboxall').prop('checked', false);
                })
            }
        });

        $('.main').click(function(){
            var mainVal=$(this).val()
            if(this.checked){
               $('.individual'+mainVal).each(function(){
                    $('.individual'+mainVal).prop('checked', true);
                })   
            }else{
                $('.individual'+mainVal).each(function(){
                    $('.individual'+mainVal).prop('checked', false);
                })  
            }
        });
        $('.individual-check').click(function(){
            var subVal=$(this).attr('val');
                // if(this.checked){
                    var uncheck=0;
                    $('.individual'+subVal).each(function(){
                        if($(this).prop('checked') == true){

                        }else{
                          uncheck++;  
                        }
                       
                     })

                    if(uncheck > 0){
                       
                        $('.main'+subVal).prop('checked', false);
                        
                    }else{
                       
                        $('.main'+subVal).prop('checked', true);
                    }
                // }else{

                // }
         });   


    });
    ")?> 
 