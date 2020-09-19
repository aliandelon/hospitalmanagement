<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\User;
use common\models\Category;
use yii\helpers\ArrayHelper;

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
            [
              'label' => 'Category',
              'attribute'=>'category_name',
              'filter'=>ArrayHelper::map(Category::find()->asArray()->all(), 'id', 'category_name'),
                'filterInputOptions' => ['class' => 'form-control', 'id' => 'category'],
              ],
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
            'user.name',
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
