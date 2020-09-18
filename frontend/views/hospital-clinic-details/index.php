<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\HospitalClinicDetailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hospital Clinic Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hospital-clinic-details-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Hospital Clinic Details', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'name',
            'type',
            'phone_number',
            // 'email:email',
            // 'have_diagnostic_center',
            // 'master_hospital_id',
            // 'same_as_hospital_details_flag',
            // 'address:ntext',
            // 'pincode',
            // 'street1',
            // 'street2',
            // 'city',
            // 'area',
            // 'latitude',
            // 'longitude',
            // 'status',
            // 'package_id',
            // 'created_by',
            // 'commision_type',
            // 'commision',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
