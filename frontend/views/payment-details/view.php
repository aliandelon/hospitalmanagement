<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\PaymentDetails */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Payment Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-details-view">

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
            'patient_id',
            'hospital_clinic_id',
            'treatment_history_id',
            'slot_day_time_mapping_id:datetime',
            'amount',
            'mode_payment',
            'pay_date',
        ],
    ]) ?>

</div>
