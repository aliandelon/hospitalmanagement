<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Schedule */

$this->title = 'Create Schedule';
$this->params['breadcrumbs'][] = ['label' => 'Schedules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row" style="background-color: #fff">
    <div class="col-md-12" style="padding-top: 30px;">
        <h4 class="page-title"><?= Html::encode($this->title) ?></h4>
    </div>
    <!-- <div class="col-lg-2" style="padding-top: 30px;">
        <div class="form-check form-check-inline" style="padding-top: 30px;width:100%">
		  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
		  Same for every week
		</div>
    </div> -->
</div>
<div class="row" style="background-color: #fff">
    <div class="col-lg-12">
		<div class="schedule-create">
		    <?= $this->render('schedule_form', [
		        'model' => $model,'list' => $list,'amount'=>$amount,'investigation'=>$investigation,'type'=>$type
		    ]) ?>

		</div>
	</div>
</div>
<script>
	var amount = '<?php echo $amount;?>';
	var investigation = '<?php echo $investigation;?>';
	var type = '<?php echo $type;?>';
</script>
<?php $this->registerJs("
$(document).ready(function(){ 
	if(type == 1)
	{
		if(amount !== '')
		{
			$('#schedule-amount').val(amount);
		}
		$('#schedule-investigation_id').val(investigation);
		if(investigation !== '')
		{
			$('#schedule-investigation_id').trigger('change');
		}
	}if(type == 2){
		$('#type').val(2);
		$('#type').trigger('change');
		$('#schedule-doctor_id').val(investigation);
		if(investigation !== '')
		{
			$('#schedule-doctor_id').trigger('change');
		}
	}
	setTimeout(function(){ yourCurrentUrl = 'create';
	window.history.pushState({}, '', yourCurrentUrl );}, 3000);

	
});
")
?>
