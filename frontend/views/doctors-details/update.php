<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DoctorsDetails */

$this->title = 'Update';
$this->params['breadcrumbs'][] = ['label' => 'Doctors Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="doctors-details-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="card-box mb-0">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
</div>
