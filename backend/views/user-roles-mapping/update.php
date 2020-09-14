<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UserRolesMapping */
$this->title = 'Update User Roles Mapping';
$this->params['breadcrumbs'][] = ['label' => 'User Roles Mappings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-roles-mapping-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_updateForm', [
        'model' => $model,'tasks'=>$tasks,'roles'=>$roles,'id'=>$id
    ]) ?>

</div>
