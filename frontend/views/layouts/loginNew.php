<?php
/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\Login2Asset;
use yii\helpers\Html;

Login2Asset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="<?= Yii::$app->request->baseUrl; ?>/img/logo/logo.png"/>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <h1>InvestiGo</h1>
            <div class="w3ls-login box box--big">
                     <?= $content ?>
            </div>
            
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>