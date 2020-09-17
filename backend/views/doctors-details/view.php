<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\DoctorsDetails */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Doctors Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doctors-details-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'hospital_clinic_id',
            'name',
            'email:email',
            'phone',
            'gender',
            'registration_no',
            'experience',
            'specialty_id',
            'qualifications',
            'address:ntext',
            'status',
            // 'created_on',
        ],
    ]) ?>

</div>
