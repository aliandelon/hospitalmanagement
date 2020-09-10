<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\UserRolesMapping */

$this->title = 'Create User Roles Mapping';
$this->params['breadcrumbs'][] = ['label' => 'User Roles Mappings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-roles-mapping-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
