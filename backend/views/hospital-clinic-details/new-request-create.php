<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\HospitalClinicDetails */

$this->title = 'New Request';
$this->params['breadcrumbs'][] = ['label' => 'New Request', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hospital-clinic-details-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('newrequest_form', [
        'model' => $model,
    ]) ?>

</div>
