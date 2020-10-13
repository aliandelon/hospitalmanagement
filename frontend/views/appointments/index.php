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

    <p>
        <input type="radio" name="appointmentType" <?php echo ($get['type']!=0) ? "checked" : "";?> onclick="window.location.href='?type=1'"> Doctors Appoinments
        <input type="radio" name="appointmentType" <?php echo ($get['type']!=1) ? "checked" : "";?> onclick="window.location.href='?type=0'"> Investigations Appoinments
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
            // 'slot_day_time_mapping_id:datetime',
            // 'hospital_clinic_id',
            'app_date',
            'app_time',

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
