<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AdminDetailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Admin Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-details-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Admin Details', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'admin_id',
            'name',
            'email:email',
            'phone_number',
            //'address:ntext',
            //'role_id',
            //'status',

            // ['class' => 'yii\grid\ActionColumn'],
             ['class' => 'yii\grid\ActionColumn',
                    'header' => 'update',
                                    'template' => '{update}'],
                ['class' => 'yii\grid\ActionColumn',
                    'header' => 'view',
                    'template' => '{view}',
                ],
        ],
    ]); ?>


</div>
