<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PaymentDetailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Payment Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-details-index">
<div class="card-box mb-0">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
              


              ['attribute'=>'patient_id',
            'label' => 'Patient',
            'filter'=>false,
            'value' => function($model){
                 $data = common\models\PatientDetails::find()->where(['id'=>$model->patient_id])->one();
                 return $data->first_name." ".$data->last_name;
               
            }
            ],    
            // 'id',
            
            // 'hospital_clinic_id',
            // 'treatment_history_id',
            // 'slot_day_time_mapping_id:datetime',
            
            
                ['attribute'=>'mode_payment',
                'label' => 'Mode Of Payment',
                'filter'=>false,
                'value' => function($model){
                        if($model->mode_payment=='1'){
                            return 'Debit Card';
                        }
                     
                   
                }
                ],    
            'pay_date',
            'amount',
             [
                'label' => 'Commission',
                'filter'=>false,
                'value' => function($model){
                    $data = common\models\HospitalClinicDetails::find()->where(['user_id'=>Yii::$app->user->identity->id])->one();
                    if($data->commision_type=='1'){
                        $ctype='Flat';
                    }else{
                        $ctype='%';
                    }
                    return  $data->commision.' '.$ctype;
                        // if($model->mode_payment=='1'){
                        //     return 'Debit Card';
                        // }
                     
                   
                }
                ],  
                'amount',
             [
                'label' => 'Earnings',
                'filter'=>false,
                'value' => function($model){

                    $data = common\models\HospitalClinicDetails::find()->where(['user_id'=>Yii::$app->user->identity->id])->one();
                    if($data->commision_type=='1'){
                        $earnings=$model->amount-$data->commision;
                    }else{
                        $per=$data->commision*($model->amount/100);
                       $earnings=$model->amount-$per;
                    }
                   
                    return  $earnings;
                        // if($model->mode_payment=='1'){
                        //     return 'Debit Card';
                        // }
                     
                   
                }
                ],     

            
        ],
    ]); 

    ?>
</div>
</div>
<?php
$this->registerJs("
// $(document).ready(function(){ 
// $('.table > tbody  > tr').each(function(index, tr) {console.log(tr.html())});  
// $('.table').append('<tr><td colspan=5></td><td>Total</td></tr>');
//     });

");
        ?>