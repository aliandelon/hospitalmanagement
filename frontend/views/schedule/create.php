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
    <div class="col-lg-8 offset-lg-2">
		<div class="schedule-create">
		    <?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>

		</div>
	</div>
</div>
