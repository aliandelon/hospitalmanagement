<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Schedule */

$this->title = 'Update Schedule';
$this->params['breadcrumbs'][] = ['label' => 'Schedules', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="schedule-update">
	<div class="row">
	    <div class="col-lg-8 offset-lg-2">
	    	<h4><?= Html::encode($this->title) ?></h4>
	    </div>
	</div>
	<div class="row">
	    <div class="col-lg-8 offset-lg-2">
		    <?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>
		</div>
	</div>
</div>
