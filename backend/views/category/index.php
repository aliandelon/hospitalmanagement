<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\User;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'category_name',
            [
               'label' => 'Status',
               'value' => function ($model) {
                   return ($model->status == 1)?'Active':'Inactive';
               }
            ],
            [
               'label' => 'Created by',
               'value' => function ($model) {
                   return User::findIdentity($model->created_by)->username;
               }
            ],
            
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
