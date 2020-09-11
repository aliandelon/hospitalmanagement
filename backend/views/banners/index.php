<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\GallerySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Banners';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?= Html::encode($this->title) ?> </h3>
            </div>

            <div class="title_right">

            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <ul class="nav navbar-right panel_toolbox">
                                                                                                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                            
                            <?= Html::a('Create Banner', ['create'], ['class' => 'btn btn-success']) ?>


                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                                                        <?= GridView::widget([
                                'dataProvider' => $dataProvider,
                                'filterModel' => $searchModel,
        'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],

                                            // 'id',
                                'name',
            [
                                    
                                    'attribute' => 'image',
                                    'value' => function($model) {

    if ($model->image != '' && $model->id != "") {
         return '<img width="100" style="border: 2px solid #d2d2d2;margin-right:.5em;" src="' . Yii::$app->request->baseUrl . '/../uploads/banners/'. $model->id.'/banner'.$model->id.'.'.$model->image . '" />';
                                           
                                        }else{
                                            return '';
                                        }
                                    },
                                    'format'=>'raw',

        
                                    ],
            // 'sort_order',
            ['attribute' => 'status',
                                    // 'filter'=>['1'=>'Enabled','0'=>'Disabled'],
                                    'value' => function($data) {
                                        if ($data->status == "1") {
                                            return "Enabled";
                                        } else {
                                            return "Disabled";
                                        }
                                    }
                                ],


                                ['class' => 'yii\grid\ActionColumn',
                                    'header' => 'Update',
                                    'template' => '{update}'],
                                ['class' => 'yii\grid\ActionColumn',
                                    'header' => 'Delete',
                                    'template' => '{delete}'],
                                ],
                                ]); ?>
                                                                    </div>
                </div>
            </div>
        </div>
    </div>
</div>