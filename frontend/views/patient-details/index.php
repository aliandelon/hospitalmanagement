<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PatientDetailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Patient Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-details-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'first_name',
            'last_name',
            'email:email',
            'phone',
            // 'profile_image:ntext',
            // 'address:ntext',
            'age',
            // 'gender',
            // 'state',
            // 'district',
            // 'city',
            // 'area',
            // 'status',
            // 'refer_id',
            // 'latitude',
            // 'longitude',
            // 'created_on',
            // 'otp',

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
