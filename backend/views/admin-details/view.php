<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\AdminDetails */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Admin Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="admin-details-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
           // 'id',
           // 'admin_id',
           
            'name',
            'email:email',
            'phone_number',
            'address:ntext',
             [

                'attribute'=>'profile_image',

                'value'=>Yii::$app->request->baseUrl .'/../uploads/admin-details/'.$model->id.'/'.$model->id.'.'.$model->profile_image,

                'format' => ['image',['width'=>'100','height'=>'100']],

            ],
            'role_id',
            [                                                  // the owner name of the model
                'label' => 'Status',
                'value' => ($model->status == 1)?'Active':'Inactive'          
            ],
        ],
    ]) ?>

</div>
