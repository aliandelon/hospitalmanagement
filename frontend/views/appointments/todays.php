<?php


use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AppointmentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Todays Appointments';
$this->params['breadcrumbs'][] = $this->title;
$get = !empty(Yii::$app->request->get()) ? Yii::$app->request->get() : array('type' =>  1);
if($get['type'] != 0){
    $tata = ArrayHelper::map(common\models\DoctorsDetails::find()->where(['hospital_clinic_id'=>Yii::$app->user->identity->id])->asArray()->all(), 'id', 'name');  
}else{
    $tata = ArrayHelper::map(common\models\HospitalInvestigationMapping::find()->where(['hospital_clinic_id'=>Yii::$app->user->identity->id])->asArray()->all(), 'id', 'investigation_id');  
    $newArr = [];
    $i = 0;
    foreach ($tata as $key => $value) {
        $det = common\models\Investigations::findOne($value);
        if(!empty($det)){
            $newArr[$key] = $det->investigation_name;
            $i++;
        }
    } 
    $tata = $newArr;
}
    $list = isset($get['list']) ? $get['list'] : '';
?>
<div class="appointments-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="row">
        <div class="col-md-12">&nbsp;</div>
        <div class="col-md-5">
            <input type="radio" name="appointmentType" <?php echo ($get['type']!=0) ? "checked" : "";?> onclick="window.location.href='?type=1'"> Doctors Appoinments
            <input type="radio" name="appointmentType" <?php echo ($get['type']!=1) ? "checked" : "";?> onclick="window.location.href='?type=0'"> Investigations Appoinments
        </div>
        <div class="col-md-4">
            <select name='list' id="list" class="form-control" data-live-search="true" onchange="window.location.href='?type=<?php echo $get['type']?>&list='+$(this).val()">
                <option value=''>Select</option>
                <?php foreach ($tata as $key => $value) {?>
                   <option value="<?php echo $key?>" <?php echo ($key==$list) ? "selected" : ""?> ><?php echo $value?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-12">&nbsp;</div>


    </div>
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
<style>
div .bootstrap-select{
    display:none;
}

</style>
<head>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
  </head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
  <script>
    $('#list').selectpicker();
  </script>