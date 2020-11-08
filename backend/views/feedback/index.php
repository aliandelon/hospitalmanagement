<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\FeedbackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Feedbacks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //echo Html::a('Create Feedback', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,  
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'user_id',
            ['attribute'=>'user_id',
            'label' => 'User Email',
            'filter'=>false,
            'value' => function($model){
                if($model->user_type=="3"){
                $data = common\models\Login::find()->where(['id'=>$model->user_id])->one();  
                $rvalue=$data->email;
               }else{
                $data = common\models\PatientDetails::find()->where(['id'=>$model->user_id])->one();  
                $rvalue=$data->first_name.' '.$data->last_name;
               }
                
                 return $rvalue;
               
            }
            ],
            // 'user_type',
            ['attribute'=>'user_type',
            'label' => 'User Type',
            'format' => 'html',
            'filter'=>false,
            'value' => function($model){
                $data = '';
                 switch($model->user_type){
                    case 3:
                        $data = "Hospital Admin";
                        break;
                    case 4:
                        $data = "Patient";
                        break;
                    default:
                        $data= "";
                        break;
                 }
                 return $data;
               
            }
            ],
            'message:ntext',
            // 'rating',
            // ['attribute'=>'rating',
            // 'label' => 'Ratings',
            // 'format' => 'html',
            // 'filter'=>false,
            // 'value' => function($model){
            //     $data = '';
            //      for($i=0;$i < 5; $i++){
            //         if($i < $model->rating){
            //             $data .= "<i class='fa fa-star' style='color:#05ab9e' aria-hidden='true'></i>";
            //         }
            //         else{
            //             $data .= "<i class='fa fa-star-o' style='color:#05ab9e'  aria-hidden='true'></i>";
            //         }
            //      }
            //      return $data;
               
            // }
            // ], 
            
            [
                'attribute'=>'submit_date',
                'label'=>'Submit Date',
                'value'=>function($model){
                 $date=date_create($model->submit_date);
                 return date_format($date,"d-m-Y");   
                }
            ]

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
