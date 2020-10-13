<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SlotDayMapping */

$this->title = 'Create Slot Day Mapping';
$this->params['breadcrumbs'][] = ['label' => 'Slot Day Mappings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slot-day-mapping-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
