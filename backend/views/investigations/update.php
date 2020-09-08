<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Investigations */

$this->title = 'Update Investigations: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Investigations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="investigations-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
