<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SlotDayTimeMapping */

$this->title = 'Create Slot Day Time Mapping';
$this->params['breadcrumbs'][] = ['label' => 'Slot Day Time Mappings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slot-day-time-mapping-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
