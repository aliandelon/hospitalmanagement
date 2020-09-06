<div class="answerd">
    <div class="answer-left">
        <img class="ans" src="<?= ($model->cb0->profile_image) ? yii\helpers\Url::base() . '/' . $model->cb0->profile_image : yii\helpers\Url::base() . '/images/de.jpg' ?>">
        <h2><?= ($model->cb0->first_name) ? $model->cb0->first_name : "" ?></h2>
        <p><?= ($model->cb0->college) ? $model->cb0->college : "" ?></p>
        <p><?= ($model->cb0->mbbs_year) ? $model->cb0->mbbs_year . ' Year' : "" ?> </p>
    </div>
    <div class="answer-right">
        <p> <?= ($model->comment) ? $model->comment : "" ?> </p>
        <span class="june"><?= ($model->cod) ? $model->cod : "" ?></span>
    </div>
</div>