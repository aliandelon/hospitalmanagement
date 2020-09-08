<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\InvestigationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Investigations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="investigations-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Investigations', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'mst_id',
            'investigation_name',
            'status',
            'created_on',
            //'created_by_type',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
