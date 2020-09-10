<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BannersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Banners';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banners-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Banners', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'expiry_date',
            'image:ntext',
            'hospital_clinic_id',
            // 'sort_order',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
