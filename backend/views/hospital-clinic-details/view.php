<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\HospitalClinicDetails */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Hospital Clinic Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hospital-clinic-details-view">

    <h1><?= Html::encode($this->title) ?></h1>

   

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            // 'user_id',
            'name',
             [   
                'attribute'=>'type',
                'format'=>'raw',//raw,
                'value' => $model->type == 1 ? 'Hospital' : 'Clinics'
                 
            ],
            'phone_number',
            'email:email',
            
              [   
                'attribute'=>'have_diagnostic_center',

                'format'=>'raw',//raw,
                'value' => $model->have_diagnostic_center == 1 ? 'Yes' : 'No'
                 
            ],

              [   
                'attribute'=>'master_hospital_id',
                'label'=>'Master Hospital',
                'format'=>'raw',//raw,
                'value' => $model->master_hospital_id == 0 ? 'No' : $model->name
                 
            ],
            
            
            [   
                'attribute'=>'same_as_hospital_details_flag',
                'label'=>'Same as hospital',
                'format'=>'raw',//raw,
                'value' => $model->same_as_hospital_details_flag == 1 ? 'YES' :'No'
                 
            ],
            'address:ntext',
            'pincode',
            'street1',
            'street2',
            'city',
            'area',
            'latitude',
            'longitude',

            
             [   
                'attribute'=>'status',
                'format'=>'raw',//raw,
                'value' => $model->status == 1 ? 'Active' :'Inactive'
                 
            ],
             
             [   
                
                'header'=>'Subscription',
                'attribute'=>'package_id',
                'format'=>'raw',//raw,
                'value'=>function($model){
                    return $model->packageDetails->package_name;
                }
                 
            ],
            
            
            'commision_type',
            'commision',
        ],
    ]) ?>
    
 
</div>
