<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\DoctorsDetails */

$this->title = 'Create Doctors Details';
$this->params['breadcrumbs'][] = ['label' => 'Doctors Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doctors-details-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
