<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\HospitalClinicDetails */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Hospital Clinic Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hospital-clinic-details-view">

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
            'user_id',
            'name',
            'type',
            'phone_number',
            'email:email',
            'have_diagnostic_center',
            'master_hospital_id',
            'same_as_hospital_details_flag',
            'address:ntext',
            'pincode',
            'street1',
            'street2',
            'city',
            'area',
            'latitude',
            'longitude',
            'status',
            'package_id',
            'created_by',
            'commision_type',
            'commision',
        ],
    ]) ?>

</div>
