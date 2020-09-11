<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RolesMst */

$this->title = 'Update Roles Mst: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Roles Msts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="roles-mst-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
