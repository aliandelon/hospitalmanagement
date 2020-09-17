<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\DoctorSpecialtyMst */

$this->title = 'Create Doctor Specialty Mst';
$this->params['breadcrumbs'][] = ['label' => 'Doctor Specialty Msts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doctor-specialty-mst-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
