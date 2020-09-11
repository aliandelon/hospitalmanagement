<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\HospitalClinicDetails */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'New Request', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hospital-clinic-details-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php echo Html::a('Update', ['newrequest-update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            'name',
            'email:email',
            [                                                  
                'label' => 'Status',
                'value' => $model->getStatusName($model->status)         
            ],
            [                                                  
                'label' => 'Commision Type',
                'value' => ($model->commision_type == '1')?'Flat':'Percentage'

            ],
            'commision',
        ],
    ]) ?>

</div>
