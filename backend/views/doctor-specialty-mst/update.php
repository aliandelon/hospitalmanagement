<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DoctorSpecialtyMst */

$this->title = 'Update Doctor Specialty Mst: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Doctor Specialty Msts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="doctor-specialty-mst-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
