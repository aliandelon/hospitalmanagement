<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\Posts */

$this->title = 'Add Post';
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="mbbs-questions">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mbb">
                <div class="mbbs-left">
                    <img class="center-block demo" src="<?php echo Url::base() . '/images/demo.jpg' ?>">

                    <ul>
                        <!-- <li><a href="#">Study</a></li> -->
                        <!-- <li><a href="#">bookmarks</a></li>-->
                        <li class="active"><a href="<?= yii::$app->urlManager->createUrl(['posts']) ?>">Posts</a></li>
                        <li><a href="#">Questions</a></li>
                        <li><a href="<?= yii::$app->urlManager->createUrl(['forms']) ?>">Latest post</a></li>
                        <li><a href="#">Plan Details</a></li>

                        <li><a href="<?= yii::$app->urlManager->createUrl(['students/update']) ?>">Edit profile</a></li>
                    </ul>

                </div>

            </div>
            <div class="col-md-8 col-sm-12 col-xs-12 ques">
                <?=
                $this->render('_form', [
                    'model' => $model,
                ])
                ?>
            </div>

        </div>
    </div>
</section>

