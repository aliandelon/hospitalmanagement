<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Investigations */

$this->title = 'Create Investigations';
$this->params['breadcrumbs'][] = ['label' => 'Investigations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="investigations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
