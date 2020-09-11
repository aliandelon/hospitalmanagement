<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RolesMst */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Roles Msts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="roles-mst-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'task',
            'sub_task',
            'sort_order',
            'status',
        ],
    ]) ?>

</div>
