<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Students */

$this->title = $model->stud_id;
$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="students-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->stud_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->stud_id], [
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
            'stud_id',
            'first_name',
            'last_name',
            'password',
            'user_id',
            'dob',
            'native_place',
            'parent_email:email',
            'native_town',
            'education',
            'education_cat',
            'mbbs_year',
            'status',
            'profile_info',
            'cod',
            'uod',
            'field',
            'field1',
            'role',
        ],
    ]) ?>

</div>
