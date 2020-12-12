<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\RefundSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Refunds';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="refund-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Refund', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'razorpay_refund_id',
            'razorpay_payment_id',
            'razorpay_order_id',
            'booking_id',
            // 'patient_id',
            // 'doctor_id',
            // 'investigation_id',
            // 'hospital_clinic_id',
            // 'app_date',
            // 'app_time',
            // 'price',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
