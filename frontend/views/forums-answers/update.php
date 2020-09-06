<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ForumsAnswers */

$this->title = 'Update Forums Answers: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Forums Answers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="forums-answers-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
