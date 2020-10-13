<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SlotDayMappingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Slot Day Mappings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slot-day-mapping-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Slot Day Mapping', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'investigation_id',
            'hospital_clinic_id',
            'doctor_id',
            'day',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
