<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SlotDayMapping */

$this->title = 'Update Slot Day Mapping: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Slot Day Mappings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="slot-day-mapping-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
