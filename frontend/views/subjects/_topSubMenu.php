<section class="mbbs-head">
        <div class="container">
                <div class="row">
                        <div class="col-md-12">
                                <div class="atags">
                                        <ul>
                                                <li class="<?= (Yii::$app->params['active'] == "study") ? 'active' : '' ?>"> <a href="<?= Yii::$app->urlManager->createUrl(['subjects/list-subjects']) ?>">studying</a></li>
                                                <li class="<?= (Yii::$app->params['active'] == "test") ? 'active' : '' ?> updatesoon"> <a href="<?= Yii::$app->urlManager->createUrl(['testpapers']) ?>">tests</a></li>
                                                <li class="<?= (Yii::$app->params['active'] == "posts") ? 'active' : '' ?> updatesoon"> <a href="<?= Yii::$app->urlManager->createUrl(['posts']) ?>">Posts</a> </li>
                                                <li class="<?= (Yii::$app->params['active'] == "forums") ? 'active' : '' ?> updatesoon"> <a href="<?= Yii::$app->urlManager->createUrl(['forms']) ?>">forums</a></li>
                                        </ul>
                                </div>
                        </div>
                </div>
        </div>
</section>


<?php
yii\bootstrap\Modal::begin([
    'id' => 'updatesoon',
]);
/* echo '<div id="status"><p>We are on the way of updating the contents.<br/>'
  . 'Your understanding and patience is greatly appreciated .</p></div>'; */
echo '<div id="status"><p><a href="https://www.facebook.com/MasterMBBS/" target="_blank">Mastermbbs</a> is a site committed to making medical learning easy and fun.<br/>'
 . ' So do write in and tell us how you would like this feature to be made for you.</p></div>';
yii\bootstrap\Modal::end();

$this->registerJs("
        $('.updatesoon').on('click',function(e){
                e.preventDefault();
                $('#updatesoon').modal('show');

        });
");


$this->registerJs("
        $('.block').on('click',function(e){
                e.preventDefault();
                $('#updatesoon').modal('show');
                return false;

        });
");
