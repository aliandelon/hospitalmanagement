<?php

namespace frontend\controllers;

use Yii;
use DateTime;
use common\models\Schedule;
use common\models\ScheduleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use common\models\HospitalInvestigationMapping;
use common\models\Category;
use common\models\HolidayList;
use common\models\SlotDayMapping;
use common\models\SlotDayMappingSearch;
use common\models\SlotDayTimeMapping;
use common\models\DoctorScheduleMapping;
use common\models\HospitalInvestigationDayMapping;
use common\models\SloatTimeMapping;
/**
 * ScheduleController implements the CRUD actions for Schedule model.
 */
class ScheduleController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /**
     * Lists all Schedule models.
     * @return mixed
     */
public function actionIndex()
{
    $searchModel = new SlotDayMappingSearch();
    $doctorsList = Schedule::find()->select('doctor_id')->distinct()->andWhere(['<>','doctor_id',''])->andWhere(['=','hospital_id',Yii::$app->user->identity->id])->one();
    $dataProvider = $searchModel->searchDoctor(Yii::$app->request->queryParams,$doctorsList->doctor_id);
        // $dataProvider = $searchModel->searchDoctor(Yii::$app->request->queryParams);
//         $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//         $render='index';
// $doctorsList = Schedule::find()->select('doctor_id')->distinct()->andWhere(['<>','doctor_id',''])->andWhere(['=','hospital_id',Yii::$app->user->identity->id])->one();
// if(!empty($doctorsList)){
//     $dataProvider = $searchModel->searchDoctor(Yii::$app->request->queryParams,$doctorsList->doctor_id);
//     $render='index';
// }else{
// $investigationList = Schedule::find()->select('investigation_id')->distinct()->andWhere(['<>','investigation_id',''])->andWhere(['=','hospital_id',Yii::$app->user->identity->id])->all();
//   $dataProvider = $searchModel->searchInvestigation(Yii::$app->request->queryParams);
//   $render='investigation-index';
// }    
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Schedule model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Schedule model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($investigation = '',$amount = '',$type = '')
    {
        $model1 = new HolidayList();
        $con = \Yii::$app->db;
        $addEvents = $model1->viewInvestigations($con);
        $model = new Schedule();
        $model2 = new HospitalInvestigationMapping();
        $transaction = $con->beginTransaction();
        $model->investigation_id = $investigation;
        if ($model->load(Yii::$app->request->post())) {
            $model->hospital_id = Yii::$app->user->identity->id;
            // $model->hospital_id = 2;
            $model2->investigation_id = $model->investigation_id;
            $model2->hospital_clinic_id = $model->hospital_id;
            $model2->amount = $model->amount;
            $model2->duration = '30';
            $model2->details =  $model->details;
            $model2->status = 1;
            $checkResult = $model->checkScheduleExist($con, $model);
            if($checkResult == 0){
                if($model->save()){
                    $check = $model2->checkHospitalInvestigation($con, $model2);
                    if($check)
                    {
                        $delete = $model2->deleteHospitalInvestigation($con, $model2);
                        if($model2->save()){
                            $transaction->commit();
                            return $this->redirect(['view', 'id' => $model->id]);
                        }else{
                            $transaction->rollback();
                            return $this->render('create', [
                                'model' => $model,
                            ]);
                        }
                    }else{
                        if($model2->save()){
                            $transaction->commit();
                            return $this->redirect(['view', 'id' => $model->id]);
                        }else{
                            $transaction->rollback();
                            return $this->render('create', [
                                'model' => $model,'model2'=>$model2
                            ]);
                        }
                    }
                }else{
                    $transaction->rollback();
                    return $this->render('create', [
                        'model' => $model,
                    ]);   
                }
            }else{
                Yii::$app->session->setFlash('error', "Same Schedule Already Exist.");
                $transaction->rollback();
                return $this->render('create', [
                    'model' => $model
                ]);  
            }
        } else {
            return $this->render('create', [
                'model' => $model,'list' => $addEvents,'amount'=>$amount,'investigation'=>$investigation,'type'=>$type
            ]);
        }
    }

    /**
     * Updates an existing Schedule model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $con = \Yii::$app->db;
        $model = $this->findModel($id);
        $model2 = new HospitalInvestigationMapping();
        $model2->investigation_id = $model->investigation_id;
        $model2->hospital_clinic_id = $model->hospital_id;
        $model2->duration = '30';
        $model2->details = '';
        $model2->status = 1;
        $check = $model2->checkHospitalInvestigation($con, $model2);
        if($check)
        {
            $model->amount = $check['amount'];
            $model2->id = $check['id'];
        }
        if ($model->load(Yii::$app->request->post())) {
            $model2->amount = $model->amount;
            if($model->save()){
                $model2->updateHospitalInvestigation($con,$model2);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Schedule model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Schedule model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Schedule the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Schedule::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSchedule() {
            $post = Yii::$app->request->post();
            $model = new Schedule();
            $model2 = new SlotDayMapping();
            $con = \Yii::$app->db;
            $transaction = $con->beginTransaction();
            $model3 = new HospitalInvestigationMapping();
            $model4 = new SlotDayTimeMapping();
            $model3->duration = '30';
            $model3->details = '';
            $model3->status = 1;
            if($post){
                // echo '<pre>';
                // print_r($post);exit;
                $hospital_id = Yii::$app->user->identity->id;
                $model->hospital_id = $hospital_id;
                $model->investigation_id = $post['investigation'];
                /*$date = date_create($post['eDate']);
                $source = str_replace('/', '-',$post['eDate']);
                $date = new DateTime($source);
                $model2->day = $date->format('Y-m-d'); */
                $model2->hospital_clinic_id = $model->hospital_id;
                $model->amount = $post['amount'];
                $model->details = $post['details'];
                $model->isHomeCollection = $post['ishomecollection'];
                if($model->createSchedule($con, $model)){
                    $start = $post['eDate'];
                    $end = $post['eDate2'];
                    $date = date_create($post['eDate']);
                    $source = str_replace('/', '-',$post['eDate']);
                    $date = new DateTime($source);
                    $startDate = $date->format('d-m-Y');
                    $date1 = date_create($post['eDate2']);
                    $source1 = str_replace('/', '-',$post['eDate2']);
                    $date1 = new DateTime($source1);
                    $endDate = $date1->format('d-m-Y');
                    //echo $startDate;echo '<br>';print_r($endDate);exit;
                    while(strtotime($startDate) <= strtotime($endDate))
                    {
                        $model2->day = date('Y-m-d',strtotime($startDate)); 
                        $model3->investigation_id = $model->investigation_id;
                        $model3->hospital_clinic_id = $model->hospital_id;
                        $model3->amount = $model->amount;
                        $model3->details = $model->details;
                        $model3->isHomeCollection=$model->isHomeCollection;

                        if($model3->saveHospitalInvestigation($con,$model3)){
                            $model2->investigation_id = $model->investigation_id;
                            if($slotId = $model2->saveSlotDayMapping($con,$model2)){
                                $slots = $post['slots'];
                                $today = $model2->day;
                                $commitflag = 1;
                                foreach ($slots as $key => $slot) {
                                    $slotsArray = explode('-', $slot);
                                    $model4->slot_day_id = $slotId;
                                    $model4->hospital_clinic_id = $model->hospital_id;
                                    $model4->investigation_id = $model->investigation_id;
                                    $model4->from_time = date('Y-m-d H:i:s',strtotime($today.' '.$slotsArray[0]));
                                    $model4->to_time = date('Y-m-d H:i:s',strtotime($today.' '.$slotsArray[1]));
                                    if($commitflag ==1 && $result = $model4->saveSlotTime($con, $model4))
                                    {
                                        // $transaction->commit();
                                        // return 'success';
                                    }else{
                                        $commitflag = 0;
                                        $transaction->rollback();
                                    }
                                }
                            }else{
                                $transaction->rollback();
                                return 'failure';
                            }
                        }else
                        {
                            $transaction->rollback();
                            return 'failure';
                        }
                        $startDate = new DateTime($startDate);
                        $startDate = $startDate->modify('+1 day');
                        $startDate = $startDate->format('Y-m-d');
                    }
                    if($commitflag == 1)
                    {
                        $transaction->commit();
                        return 'success';
                    }else{
                        $transaction->rollback();
                        return 'failure';
                    }
                }else{
                    $transaction->rollback();
                    return 'failure';
                }
            }
            
        }

        public function actionViewschedule() {
            $post = Yii::$app->request->post();
            $model = new Schedule();
            $con = \Yii::$app->db;
            $hospitalId = Yii::$app->user->identity->id;
            $type = $post['type'];
            $option = $post['option'];
            if($type == 1)
            {
                $addSchedule = $model->viewSchedule($con, $hospitalId, $option);
                echo json_encode($addSchedule);
            }else{
                $addSchedule = $model->viewDoctorSchedule($con, $hospitalId, $option);
                echo json_encode($addSchedule);
            }
        }

         public function actionGetInvestigationSchedule() {
            $post = Yii::$app->request->post();
            $model = new Schedule();
            $con = \Yii::$app->db;
            $hospitalId = Yii::$app->user->identity->id;
            $getScheduleDetails = $model->getScheduleDetails($hospitalId, $post['option']);
            return json_encode($getScheduleDetails);
        }

         public function actionGetDoctorSchedule() {
            $post = Yii::$app->request->post();
            $model = new Schedule();
            $con = \Yii::$app->db;
            $hospitalId = Yii::$app->user->identity->id;
            $getScheduleDetails = $model->getDoctorScheduleDetails($hospitalId, $post['option']);
            return json_encode($getScheduleDetails);
        }




        public function actionDeleteSchedule()
        {
            $model = new Schedule();
            $post = Yii::$app->request->post();
            //$startDate = date('m/d/Y H:i:s', strtotime($post['start/']));
            //new DateTime($post['start/']);
            $endDate = $post['end/'];
            //$model2->day = $date->format('Y-m-d'); 
            $time = strtotime($endDate);
            $time = $time - (30 * 60);
            $startDate = date("Y-m-d H:i:s", $time);
            $model->hospital_id = Yii::$app->user->identity->id;
            $model->investigation_id = $post['investigation/'];
            $investigation = $post['investigation/'];
            $amount = $post['amount/'];
            $type = $post['type/'];
            if($type == 1){
                $deleteSchedule = $model->deleteSchedule($model, $startDate, $endDate);
            }else{
                $deleteSchedule = $model->deleteDoctorSchedule($model, $startDate, $endDate);
            }
            if($deleteSchedule)
            {
                return $this->redirect(['create','investigation'=>$investigation,'amount'=>$amount,'type'=>$type]);
            }
        }
        public function actionDoctorSchedule() {
            $post = Yii::$app->request->post();
            $model = new Schedule();
            $model2 = new SlotDayMapping();
            $con = \Yii::$app->db;
            $transaction = $con->beginTransaction();
            $model3 = new DoctorScheduleMapping();
            $model4 = new SlotDayTimeMapping();
            //$model3->duration = '30';
           //$model3->details = '';
            //$model3->status = 1;


            // echo '<pre>';
            // print_r($post);exit;
            if($post){
                $hospital_id = Yii::$app->user->identity->id;
                $model->hospital_id = $hospital_id;
                // $date = date_create($post['eDate']);
                // $source = str_replace('/', '-',$post['eDate']);
                // $date = new DateTime($source);
                // $model2->day = $date->format('Y-m-d'); 
                  $model->amount = $post['amount'];
                $model2->hospital_clinic_id = $model->hospital_id;
                $model->doctor_id = $post['doctor'];
                if($model->createDoctorSchedule($con, $model)){
                    //$model3->investigation_id = $model->investigation_id;
                    $model3->doctor_id=$model->doctor_id;
                    $model3->hospital_clinic_id = $model->hospital_id;
                    $model3->amount = $model->amount;
                    if($model3->saveDoctorInvestigation($con,$model3)){
                        $start = $post['eDate'];
                        $end = $post['eDate2'];
                        $date = date_create($post['eDate']);
                        $source = str_replace('/', '-',$post['eDate']);
                        $date = new DateTime($source);
                        $startDate = $date->format('d-m-Y');
                        $date1 = date_create($post['eDate2']);
                        $source1 = str_replace('/', '-',$post['eDate2']);
                        $date1 = new DateTime($source1);
                        $endDate = $date1->format('d-m-Y');
                    while(strtotime($startDate) <= strtotime($endDate))
                    {
                    //echo $startDate;echo '<br>';print_r($endDate);exit;
                        $model2->day = date('Y-m-d',strtotime($startDate)); 
                        $model2->investigation_id = $model->investigation_id;
                        $model2->doctor_id = $model->doctor_id;
                        if($slotId = $model2->saveDoctorSlotDayMapping($con,$model2)){
                            $slots = $post['slots'];
                            $today = $model2->day;
                            $commitflag = 1;
                            foreach ($slots as $key => $slot) {
                                $slotsArray = explode('-', $slot);
                                $model4->slot_day_id = $slotId;
                                $model4->doctor_id = $model->doctor_id;
                                $model4->hospital_clinic_id = $model->hospital_id;
                                $model4->from_time = date('Y-m-d H:i:s',strtotime($today.' '.$slotsArray[0]));
                                $model4->to_time = date('Y-m-d H:i:s',strtotime($today.' '.$slotsArray[1]));
                                if($commitflag ==1 && $result = $model4->saveDoctorSlotTime($con, $model4))
                                {
                                    // $transaction->commit();
                                    // return 'success';
                                }else{
                                    $commitflag = 0;
                                    $transaction->rollback();
                                }
                                //print_r($model4->save());echo '<br>';
                            }
                        }else{
                            $transaction->rollback();
                            return 'failure';
                        }
                    // }else
                    // {
                    //     $transaction->rollback();
                    //     return 'failure';
                    // }
                        $startDate = new DateTime($startDate);
                        $startDate = $startDate->modify('+1 day');
                        $startDate = $startDate->format('Y-m-d');
                    }
                    if($commitflag == 1)
                    {
                        $transaction->commit();
                        return 'success';
                    }else{
                        $transaction->rollback();
                        return 'failure';
                    }
                }else{
                    $transaction->rollback();
                    return 'failure';
                }


                 }else{
                    $transaction->rollback();
                    return 'failure';
                }






            }
            
        }



 public function actionViewTime()
    {
        $post = Yii::$app->request->post();
        if($post){
            $slotid = $post['slotid'];
            

        }
        // SELECT DATE_FORMAT(from_time,'%h:%i %p') FROM `slot_day_time_mapping` WHERE 1
$slotDayTime = SlotDayTimeMapping::find()->where(['slot_day_id'=>$slotid])->all();
        $this->layout = FALSE;
    return $this->renderAjax('_slotDayTime',['slotDayTime'=>$slotDayTime]);
        
        
    }

    public function actionResetSession(){
        $session = Yii::$app->session;
        unset($session['arrayList']);
        echo "reset";
    }

    public function actionSetInvestigationList(){
        $post = Yii::$app->request->post();
        $index = $post['trId'];
        $checkbox = $post['checkbox'];
        $days = $post['days'];
        // $timeSlots = $post['timeSlots'];
        $rate = $post['rate'];
        $package = $post['package'];
        $session = Yii::$app->session;
        $abc = $session['arrayList'];
        $abc[$index]['check'] = $checkbox;
        $abc[$index]['days'] = $days;
        // $abc[$index]['timeslot'] = $timeSlots;
        $abc[$index]['rate'] = $rate;
        $abc[$index]['package'] = $package;
        $session['arrayList'] = $abc;
        print_r($session['arrayList']);
    } 


    public function actionSaveInvestigation(){
         $session = Yii::$app->session;
            if(isset($session['arrayList'])){
                   foreach ($session['arrayList'] as $key => $value) {
                    if(!empty($value)){
                      $category_inv=explode('_', $key);
                      $category=$category_inv[0];
                      $investigation=$category_inv[1];
                      $days=($value['days'])?$value['days']:'';

                      // $timeslot=$value['timeslot'];
                        if(!empty($days)){
                             $model3=new HospitalInvestigationMapping();
                             $model3->investigation_id=$investigation;
                             $model3->hospital_clinic_id=Yii::$app->user->identity->id;
                             $model3->amount =($value['rate'])?$value['rate']:0;
                             $model3->isHomeCollection=1;
                             $model3->details=($value['package'])?$value['package']:'';
                             $model3->modeleInsert($model3);
                             $this->saveDaysTime($days,$investigation,$category);
                        }

                    }

                       
                   }
            }
    }

    protected function saveDaysTime($days,$investigation,$category){
       
        
            foreach ($days as $key => $value) {
                    $model = new HospitalInvestigationDayMapping();
                    $model->hospital_id=Yii::$app->user->identity->id;
                    $model->investigation_id=$investigation;
                    $model->category_id=$category;
                    $model->day_id=$key;
                    $lstId = $model->daySave($model);
                    $timeSlots  = $value;
                    if($lstId){
                        // print_r($linsertID);exit;
                         foreach ($timeSlots as $key2 => $value2) {
                             $model2 = new SloatTimeMapping();
                             $model2->hospital_id=Yii::$app->user->identity->id;
                             $model2->investigation_mapping_id=  $lstId;
                             $model2->slot_time =$value2;
                            if($model2->timeSave($model2)){

                            }else{
                            print_r($model2->getErrors());exit;
                            };
                        }   
                    }else{
                            print_r($model->getErrors());exit;
                        }
                    

            }
       
    }
   





    public function actionGetInvestigationList(){
        $model = new Schedule();
        $post = Yii::$app->request->post();
        $categoryId = $post['category'];
        $designStr = "";
        $abc = [];
        $session = Yii::$app->session;
        $session['arrayList'] = isset($session['arrayList']) ? $session['arrayList'] : [];
        $abc = $session['arrayList'];
        // foreach ($array as $key => $value) {
            $category = Category::find()->where(["id"=>$categoryId])->all();
            $listData=ArrayHelper::map($category,'id','category_name');
            $investigationList = $model->getInvestigationList($categoryId);
            
            if(sizeof($investigationList) > 0){
        $designStr .= '<div class="panel panel-success">
                            <div class="panel-heading">'.$listData[$categoryId].'</div>
                            <div class="panel-body">
                                <div class="table">
                                    <div class="table-responsive">
                                        <table class="table table-stripped">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Investigations</th>
                                                    <th>Day &amp; Time slots</th>
                                                    <th>Rate</th>
                                                    <th>Package Details</th>
                                                </tr>
                                            </thead>
                                            <tbody>';
                                            foreach ($investigationList as $key => $investigation) {
                                                $invDetails = $model->getInvestigationDaySlotDetails($investigation['id']);
                                                // echo "<pre>";print_r($invDetails);exit;
                                                $index = $categoryId.'_'.$investigation['id'];
                                                // $xyz[$index] = isset($abc[$index]) ? $abc[$index] : [];
                                                // $checkbox = isset($xyz[$index]['check']) ? $xyz[$index]['check'] : "";
                                                // $days = isset($xyz[$index]['days']) ? $xyz[$index]['days'] : [];
                                                // $timeslot = isset($xyz[$index]['timeslot']) ? $xyz[$index]['timeslot'] : [];
                                                // $rate = isset($xyz[$index]['rate']) ? $xyz[$index]['rate'] : "";
                                                // $package = isset($xyz[$index]['package']) ? $xyz[$index]['package'] : "";
                                                
                                                $rate = $investigation['amount'];
                                                $package = $investigation['details'];
                                                $days = $timeslot = [];
                                                $dayId = "";
                                                foreach($invDetails as $invValue){
                                                    // if(!in_array($invValue['day_id'], $days)){
                                                    //     array_push($days,$invValue['day_id']);    
                                                    // }
                                                    // if(!in_array($invValue['slot_time'], $timeslot)){
                                                    //     array_push($timeslot,$invValue['slot_time']);
                                                    // }
                                                    if($dayId != $invValue['day_id']){
                                                        $dayId = $invValue['day_id'];
                                                        $timeSlotval = [];
                                                        array_push($timeSlotval, $invValue['slot_time']);
                                                    }else{
                                                        array_push($timeSlotval, $invValue['slot_time']);
                                                    }
                                                    $days[$dayId] = $timeSlotval;
                                                    
                                                }
                                                $checkbox = '';
                                                if(!empty($days)){
                                                    $checkbox = 'checked';
                                                }
                                                
                                                // $abc[$index]['timeslot'] = $timeslot;
                                                $abc[$index]['days'] = $days;
                                                $abc[$index]['rate'] = $rate;
                                                $abc[$index]['package'] = $package;
                                                $abc[$index]['check'] = 1;
                                                
                                                $session['arrayList'] = $abc;
                                                
                                                $designStr .=  '<tr id="'.$index.'">
                                                    <td class="pt20"><input class="checkbox" type="checkbox" name="investigations" onchange="callSessionMaintain(\''.$index.'\');" value="'.$investigation['id'].'" '.$checkbox.'></td>
                                                    <td class="pt20">'.$investigation['investigation_name'].'</td>
                                                    <td style="max-width:500px !important;"><div class="col-md-12">';
                                                    $daysArray = array(0=>"Monday",1=>"Tuesday",2=>"Wednesday",3=>"Thursday",4=>"Friday",5=>"Saturday",6=>"Sunday");
                                                    foreach ($daysArray as $key => $value) {  
                                                        $designStr .= '<div class="col-md-6"><p>'.$value.'</p><select class="form-control timeslot" id="'.$index.'_'.$value.'" name="timeSlots" multiple onchange="callSessionMaintain(\''.$index.'\');">';
                                                        $chekValue = !empty($days) ? $days[$key] :  [];
                                                        $designStr .= $this->getTimeSlotOptions($chekValue);    
                                                        $designStr .=  '</select></div>';
                                                    }
                                                    $designStr .=  '</div></td>
                                                    <td style="max-width:100px"><input class="form-control rate" value="'.$rate.'" type="text" name="rate" placeholder="Rate" onchange="callSessionMaintain(\''.$index.'\');"></td>
                                                    <td><textarea class="form-control package" name="package" onchange="callSessionMaintain(\''.$index.'\');">'.$package.'</textarea></td>
                                                </tr>';
                                            }
                                            $designStr .= '</tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    }//}
                    // $session['arrayList'] = $xyz;
                    echo $designStr;
    }

    public function getTimeSlotOptions($checkVal){
        $model = new Schedule();
        $string = "";
        $timeSlots = $model->getTimeSlotOptions();
        foreach ($timeSlots as $key => $value) {
            $checked = '';
            if(in_array($value['tmeSlot'], $checkVal)){
                $checked = 'selected';
            }
            $string .= '<option value="'.$value['tmeSlot'].'"'.$checked.'>'.$value['tmeSlot'].'</option>';
        }
        return $string;
    }

    public function getDocTimeSlotOptions($checkVal){
        $model = new Schedule();
        $string = "";
        $timeSlots = $model->getTimeSlotOptions();
        foreach ($timeSlots as $key => $value) {
            $checked = '';
            if(in_array($value['tmeSlot'], $checkVal)){
                $checked = 'selected';
            }
            $string .= '<option value="'.$value['tmeSlot'].'"'.$checked.'>'.$value['tmeSlot'].'</option>';
        }
        return $string;
    }

    public function actionGetDoctorDetails(){
        $model = new Schedule();
        $post = Yii::$app->request->post();
        $docId = $post['docId'];
        $days = [];
        $designStr = '<div class="col-md-12">';
        $daysArray = array(0=>"Monday",1=>"Tuesday",2=>"Wednesday",3=>"Thursday",4=>"Friday",5=>"Saturday",6=>"Sunday");
        foreach ($daysArray as $key => $value) {  
            $designStr .= '<div class="col-md-6"><p>'.$value.'</p><select class="form-control doctimeslot" id="'.$docId.'_'.$value.'" name="timeSlots" multiple onchange="callSessionMaintain(\''.$docId.'\');">';
            $chekValue = !empty($days) ? $days[$key] :  [];
            $designStr .= $this->getDocTimeSlotOptions($chekValue);    
            $designStr .=  '</select></div>';
        }
        $designStr .=  '</div>';
        print_r($designStr);
    }

}
