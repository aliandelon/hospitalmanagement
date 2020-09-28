<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AppointmentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Appointments';
$this->params['breadcrumbs'][] = $this->title;
$get = !empty(Yii::$app->request->get()) ? Yii::$app->request->get() : array('type' =>  1);

?>
<div class="appointments-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <input type="radio" name="appointmentType" <?php echo ($get['type']!=0) ? "checked" : "";?> onclick="window.location.href='?type=1'"> Doctors Appoinments
        <input type="radio" name="appointmentType" <?php echo ($get['type']!=1) ? "checked" : "";?> onclick="window.location.href='?type=0'"> Investigations Appoinments
    </p>
    <?php 
    echo isset($get['type']) ?
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'patient_id',
            ['attribute'=>'patient_id',
            'label' => 'Patient',
            'filter'=>false,
                'value' => function($model){
                     $tata = common\models\PatientDetails::findOne($model->patient_id);
                     if(!empty($tata)){
                        return $tata->first_name.' '.$tata->last_name;
                    }else{
                        return "";
                    }
            }],
            ['attribute'=>'doctor_id',
            'label' => 'Doctor',
            'filter'=>false,
            'visible' => ($get['type'] != 0) ? true : false,
            'value' => function($model){
                 $tata = common\models\DoctorsDetails::findOne($model->doctor_id);
                 if(!empty($tata)){
                    return $tata->name;
                }else{
                    return "";
                }
                 
               
            }
            ],  
            ['attribute'=>'investigation_id',
            'label' => 'Investigation',
            'visible' => ($get['type'] != 1) ? true : false,
            // 'filter'=>ArrayHelper::map(common\models\Investigations::find()->where(['hospital_clinic_id'=>$searchModel->hospital_clinic_id])->asArray()->all(), 'id', 'investigation_name'),
            'value' => function($model){
                 $data = common\models\HospitalInvestigationMapping::findOne($model->investigation_id);
                 if(!empty($data)){
                    $data1= common\models\Investigations::findOne($data->investigation_id);
                    if(!empty($data1)){
                        return $data1->investigation_name;
                    }else{
                        return "";
                    }
                 }else{
                    return "";
                 }
                 
               
            }
            ],
            // 'slot_day_time_mapping_id:datetime',
            ['attribute'=>'slot_day_time_mapping_id',
            'label' => 'Slot',
            'filter'=>false,
            'value' => function($model){
                 $data = common\models\SlotDayTimeMapping::find()->where(['id'=>$model->slot_day_time_mapping_id])->one();
                 return $data->from_time.'-'.$data->to_time;
               
            }
            ],
            ['attribute'=>'hospital_clinic_id',
            'label' => 'Hospital',
            'filter'=>false,
            'value' => function($model){
                 $data = common\models\HospitalClinicDetails::find()->where(['user_id'=>$model->hospital_clinic_id])->one();
                 return $data->name;
               
            }
            ],
            // 'app_date',
            // 'app_time',
            // 'appointment_type',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ])  : "";?>
</div>