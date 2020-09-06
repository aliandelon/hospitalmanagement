<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\StudentPlanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Student Plans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-plan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Student Plan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'student_id',
            'plan_id',
            'cod',
            'start_date',
            // 'expiry_date',
            // 'uod',
            // 'status',
            // 'free_trial',
            // 'free_start',
            // 'free_end',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
