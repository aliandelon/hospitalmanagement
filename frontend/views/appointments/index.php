<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
<div class="card-box mb-0">
    <p>
        <input type="radio" name="appointmentType" <?php echo ($get['type']!=0) ? "checked" : "";?> onclick="window.location.href='?type=1'"> Doctors Appoinments
        <input type="radio" name="appointmentType" <?php echo ($get['type']!=1) ? "checked" : "";?> onclick="window.location.href='?type=0'"> Investigations
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
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
            // 'doctor_id',
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
             ['attribute'=>'app_time',
            'label' => 'Appointment Time',
            'filter'=>false,
            'value' => function($model){
                 $datea= date_create($model->app_time);
                return date_format($datea,'h:i A');
              
               
            }
            ],  
             ['attribute'=>'app_date',
            'label' => 'Appointment Date',
            'filter'=>false,
            'value' => function($model){
                 $datea= date_create($model->app_date);
                return date_format($datea,'d-m-Y');
                //  $tata = common\models\DoctorsDetails::findOne($model->doctor_id);
                //  if(!empty($tata)){
                //     return $tata->name;
                // }else{
                //     return "";
                // }
                 
               
            }
            ],  
        ],
    ]); ?>
</div>
</div>