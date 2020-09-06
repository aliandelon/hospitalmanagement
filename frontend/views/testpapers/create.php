<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Testpapers */

$this->title = 'Create Testpapers';
$this->params['breadcrumbs'][] = ['label' => 'Testpapers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="testpapers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
