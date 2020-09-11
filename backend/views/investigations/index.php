<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\Category;

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

            [
                'attribute'=>'mst_id',
                'label' => 'Category',
                'value' => function($model){
                    return $model->category->category_name;
                },
                'filter'=>ArrayHelper::map(Category::find()->asArray()->all(), 'id', 'category_name'),
                'filterInputOptions' => ['class' => 'form-control', 'id' => 'category'],
            ],
            'investigation_name',
            [   
                'attribute'=>'status',
                'format'=>'raw',//raw,
                'filter'=>['1'=>'Active','0'=>'In Active'],
                'filterInputOptions' => ['class' => 'form-control', 'id' => 'leave_status'],
                'value'=>function($model){
                    if($model->status=="1"){
                     return Html::a('<span class="label label-success">Active</span>');
                     }else{
                    return Html::a("<span class='label label-warning'>In Active</span>");
                     }    
                     
                }
            ],
            'created_on',
            //'created_by_type',

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
