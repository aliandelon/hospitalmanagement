<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Request password reset';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="login">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="cl-effect-5">
                    <a href="#"><span data-hover="Login">FORGOT PASSWORD</span></a>

                </nav>
                <img class="center-block dots" src="<?= \yii\helpers\Url::base() . '/images/dots.png' ?>">
                <div class="new_form">
                    <p style="text-align: center;"> <?= Yii::$app->session->getFlash('spr'); ?></p>
                    <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form', 'options' => ['role' => 'form']]); ?>

                    <div class="form-group">
                        <?= $form->field($model, 'user_id')->textInput(['autofocus' => true, 'class' => 'form-new', 'placeholder' => 'Email'])->label(false) ?>
                    </div>

                    <?= Html::submitButton('Send', ['class' => 'btn new-btn btn-default', 'id' => 'pwd_req_btn', 'name' => 'password-reset-button']) ?>

                    <?php ActiveForm::end(); ?>


                </div>
            </div>
        </div>
    </div>
</section>

<?php /*
$this->registerJs("
 $(document).ready(function () {
    $('#request-password-reset-form').on('beforeSubmit', function (event, messages) {
        $('#pwd_req_btn').attr('disabled', true)
        $('#pwd_req_btn') . html('please wait....');
        return true;
    });
});
");*/
