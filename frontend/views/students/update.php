<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Students */

$this->title = 'Update Students: ' . $model->user_id;
$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<section class="mbbs-profile">
    <div class="container">
        <div class="row">
            <?= $this->render('_menuLinks') ?>
            <div class="col-md-8 col-sm-12 col-xs-12 prime">

                <?=
                $this->render('_updateForm', [
                    'model' => $model,
                ])
                ?>

            </div>

        </div>
    </div>
</section>
