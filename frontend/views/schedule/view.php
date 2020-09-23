<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Schedule */

$this->title = 'View Schedule';
$this->params['breadcrumbs'][] = ['label' => 'Schedules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="schedule-view">

    <h1><?= Html::encode($model->investigations->investigation_name) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [                                                 
                'label' => 'Inveastigation',
                'value' => $model->investigations->investigation_name,          
            ],
            [                                                 
                'label' => 'Inveastigation Categoty',
                'value' => $model->investigations->category->category_name,          
            ],
            
            // [                                                 
            //     'label' => 'Hospital',
            //     'value' => $model->hospital->name,          
            // ],
            [                                                 
                'label' => 'Doctor',
                'value' => ($model->doctor_id != '')?$model->doctor->name:'',          
            ],
            [                                                  
                'label' => 'sunday_holiday',
                'value' => ($model->sunday_holiday == 1)?'Yes':'No'          
            ],
            [                                                 
                'label' => 'Status',
                'value' => ($model->status == 1)?'Active':'Inactive'          
            ],
            'created_on',
        ],
    ]) ?>

</div>
