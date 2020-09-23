<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Schedule */

$this->title = 'Create Schedule';
$this->params['breadcrumbs'][] = ['label' => 'Schedules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row" style="background-color: #fff">
    <div class="col-lg-8 offset-lg-2" style="padding-top: 30px">
        <h4 class="page-title"><?= Html::encode($this->title) ?></h4>
    </div>
</div>
<div class="row" style="background-color: #fff">
    <div class="col-lg-12">
		<div class="schedule-create">
		    <?= $this->render('schedule_form', [
		        'model' => $model,'list' => $list,'amount'=>$amount,'investigation'=>$investigation
		    ]) ?>

		</div>
	</div>
</div>
<script>
	var amount = '<?php echo $amount;?>';
	var investigation = '<?php echo $investigation;?>';
</script>
<?php $this->registerJs("
$(document).ready(function(){ 
	if(amount !== '')
	{
		$('#schedule-amount').val(amount);
	}
	$('#schedule-investigation_id').val(investigation);
	if(investigation !== '')
	{
		$('#schedule-investigation_id').trigger('change');
	}
});
")
?>
