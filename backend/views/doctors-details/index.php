<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DoctorsDetailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Doctors Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doctors-details-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!-- <p>
        <? //Html::a('Create Doctors Details', ['create'], ['class' => 'btn btn-success']) ?>
    </p> --> 
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'hospital_clinic_id',
            ['attribute'=>'name',
            'label' => 'Doctors Name',
            'filter'=>false,
            'value' => function($model){
                 $data = 'Dr. '.$model->name;
                 return $data;
               
            }],
            ['attribute'=>'hospital_clinic_id',
            'label' => 'Hospital',
            'filter'=>false,
            'value' => function($model){
                 $data = common\models\HospitalClinicDetails::find()->where(['user_id'=>$model->hospital_clinic_id])->one();
                 return isset($data->name)?$data->name:"";
               
            }
            ],            
            // 'gender',
            // 'registration_no',
            // 'experience',
            // 'profile_image:ntext',
            ['attribute'=>'specialty_id',
            'label' => 'Specialization',
            'filter'=>false,
            'value' => function($model){
                 $data = common\models\DoctorSpecialtyMst::find()->where(['id'=>$model->specialty_id])->one();
                 return $data->name;
               
            }
            ],
            'qualifications',
            'email:email',
            'phone',
            // 'address:ntext',
            // 'status',
            // 'created_on',

            // ['class' => 'yii\grid\ActionColumn',
            //     'header' => 'view',
            //     'template' => '{view}',
            //     ],
        ],
    ]); ?>
</div>
