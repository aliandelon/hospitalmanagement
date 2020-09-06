<?php

use frontend\models\Testpapers;

$testpap = new Testpapers();

$ans = $testpap->loadAnswer(($model['question_id']) ? $model['question_id'] : 0)
?>

<div class = "takes">
    <div class="clearfix" style="padding-bottom: 20px"></div>

    <div class = "taketest">
        <div class="row">
            <div class="col-sm-6">
                <p>Question: <?= ($model['question']) ? $model['question'] : '' ?></p>
            </div>
            <div class="col-sm-6" id="test-status" style="display: none;">
                <form class="form">
                    <div class="switch-field">
                        <input  type="radio" id="switch_left" name="switch_2" value="yes" checked/>
                        <label for="switch_left">Yes</label>
                        <input  type="radio" id="switch_right" name="switch_2" value="no" />
                        <label for="switch_right">No</label>
                    </div>
                </form>
            </div>
        </div>


    </div>
    <div class = "taketests">
        <span class="glyphicons glyphicons-tick correct"></span>
        <span class="glyphicons glyphicons-remove wrong" ></span>
        <form id='chk-knw-form'>
            <input  id="chk-questionid" type = "hidden" value = "<?= $model['question_id']; ?>">
            <ul class = "list-unstyled">

                <?php
                $i = 1;
                foreach ($ans as $ans) {
                        ?>

                        <li>
                            <input  type = "radio" class = "rad" name = "rec" value = "<?= $ans['option_id'] ?>" checked = ""> <?= $i ?>)
                        <?= ($ans['options']) ? $ans['options'] : '' ?>
                        </li>
                        <?php
                        $i++;
                }
                ?>
            </ul>
        </form>
        <div id="solutions" class = "taketest" ></div>

    </div>

</div>

<?php
$this->registerJs("
 		$(document).ready(function(){
 		$('input:radio').change(function(e) {

                        e.preventDefault();
 			var seleid = $('input[name=rec]:checked', '#chk-knw-form').val();
 			var qustid =  $('#chk-questionid').val();
 			$.ajax({
 				url:baseurl+'testpapers/check-answer',
 				data:{'id':seleid,'qustid':qustid},
 				type:'POST',
 				beforesend:function(){

 					$('.check').prop('disabled', true);
 					$('.check').html('Validating.....');
 					$('.pagination li span button').prop('display','none');
 				},

 				success:function(data){
 					$('.next a button').text('Next');
 					if(data.response==200){
                                                $('#switch_left').prop('checked', true);
                                                $('#test-status').show();
 						$('#solutions').html(data.solutions);

 					}
 				if(data.response==201){
                                                $('#switch_right').prop('checked', true);
                                                $('#test-status').show();
 						$('#solutions').html(data.solutions);

 					}
 				},
 				error:function(){
 				}


			});

			});


			});

 		");
?>