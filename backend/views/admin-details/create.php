<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AdminDetails */

$this->title = 'Create Admin Details';
$this->params['breadcrumbs'][] = ['label' => 'Admin Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-details-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<script>
$('document').ready(function(){
	alert(1);
	$("body").on('click', '.toggle-password', function() {
	alert(123);
	  $(this).toggleClass("fa-eye fa-eye-slash");
	  var input = $("#passid");
	  if (input.attr("type") === "password") {
	    input.attr("type", "text");
	  } else {
	    input.attr("type", "password");
	  }

	});
});
</script>
