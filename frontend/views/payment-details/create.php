<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PaymentDetails */

$this->title = 'Create Payment Details';
$this->params['breadcrumbs'][] = ['label' => 'Payment Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-details-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
