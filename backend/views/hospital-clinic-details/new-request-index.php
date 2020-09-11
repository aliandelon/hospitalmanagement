<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\HospitalClinicDetailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'New Request Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hospital-clinic-details-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('New Request', ['new-request'], ['class' => 'btn btn-primary']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'user_id',
            'name',
            'type',
            'phone_number',
            'email:email',
            // 'have_diagnostic_center',
            // 'master_hospital_id',
            // 'same_as_hospital_details_flag',
            // 'address:ntext',
            // 'pincode',
            // 'street1',
            // 'street2',
            // 'city',
            // 'area',
            // 'latitude',
            // 'longitude',
            [                                                  
                'label' => 'Status',
                'value' => function($model)
                {
                    return $model->getStatusName($model->status);
                    }        
            ],
            // 'package_id',
            // 'created_by',
            // 'commision_type',
            // 'commision',

            /*['class' => 'yii\grid\ActionColumn',
                    'header' => 'update',
                    'template' => '{update}'],
            ['class' => 'yii\grid\ActionColumn',
                'header' => 'view',
                'template' => '{view}',
            ],*/

            [
          'class' => 'yii\grid\ActionColumn',
          'header' => 'Actions',
          'headerOptions' => ['style' => 'color:#337ab7'],
          'template' => '{view}{update}',
          'buttons' => [
            'view' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['newrequest-view','id'=>$model->id], [
                            'title' => Yii::t('app', 'lead-view'),
                ]);
            },

            'update' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['newrequest-update','id'=>$model->id], [
                            'title' => Yii::t('app', 'lead-update'),
                ]);
            },

          ],
      ]




        ],
    ]); ?>
</div>
