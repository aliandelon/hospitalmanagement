<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\Posts */

$this->title = 'Add Question';
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_topSubMenu'); ?>
<section class="mbbs-questions">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mbb">
                <div class="mbbs-left">
                    <img class="center-block demo" src="<?php echo Url::base() . '/images/demo.jpg' ?>">

                    <ul>
                        <li><a href="#">bookmarks</a></li>
                        <li><a href="#">My posts</a></li>
                        <li><a href="#">My questions</a></li>
                        <li><a href="#">Latest post</a></li>
                        <li><a href="#">Plan destails</a></li>
                        <li class="active"><a href="editprofile.php">Edit profile</a></li>
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

