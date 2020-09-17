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
    <!-- <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   <p>
        <?php // echo Html::a('Create Patient Details', ['create'], ['class' => 'btn btn-success']) ?>
    </p>-->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            ['attribute'=>'first_name',
            'label' => 'Patients Name',
            'filter'=>false,
            'value' => function($model){
                 $data = $model->first_name." ".$model->last_name;
                 return $data;
               
            }
            ], 
            'email:email',
            'phone',
            // 'profile_image:ntext',
            // 'address:ntext',
            // 'age',
            ['attribute'=>'gender',
            'label' => 'Gender',
            'filter'=>false,
            'value' => function($model){
                 $data = ($model->gender != 1) ? "Female" : "Male";
                 return $data;
               
            }
            ],  
            'state',
            'district',
            // 'city',
            // 'area',
            // 'status',
            // 'created_on',

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
