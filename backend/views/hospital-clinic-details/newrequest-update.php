<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\HospitalClinicDetails */

$this->title = 'Update New Request: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'New Requst', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hospital-clinic-details-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('newrequest_form', [
        'model' => $model,
    ]) ?>

</div>
<?php $this->registerJs("
     $(document).ready(function() {
     	$('body').on('click', '.toggle-password', function() {
		  $(this).toggleClass('fa-eye fa-eye-slash');
		  var input = $('#hospitalclinicdetails-password');
		  if (input.attr('type') === 'password') {
		    input.attr('type', 'text');
		  } else {
		    input.attr('type', 'password');
		  }

		});
     });
")?> 
