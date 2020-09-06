<?php
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TestpapersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'mastermbbs-Testpapers';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_topSubMenu'); ?>
<section class="mbbs-profile">
    <div class="container">


        <div class="row">
            <div class="col-md-3">

            </div>
            <div class="col-md-9 zeros">
                <h6>Check you knowledge:</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 test">
                <div class="mbbs-left">
                    <ul>
                        <?php foreach ($subjects as $value) { ?>
                                <li><a id='test-<?= $value['sub_id'] ?>' href="<?= $value['sub_name'] ?>" class='test-subject'><?= $value['sub_name'] ?></a></li>
                        <?php } ?>

                    </ul>

                </div>

            </div>

            <div class="col-md-9 col-sm-12 col-xs-12 primes">
                <div class="sixty sixs">
                    <div class="panel-group" id="accordion">
                        <?php foreach ($defaultsubject as $testlist) { ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading startz nw">
                                        <a   href="<?= \yii\helpers\Url::base() . '/testpapers/take-test?chapterid=' . $testlist['chapter_id'] ?>">   <h4 class="panel-title">
                                                <?= ($testlist['chapter_name']) ? $testlist['chapter_name'] : 'Chapter' ?><span class="mans">take the test</span>
                                            </h4>
                                        </a>
                                    </div>

                                </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
$this->registerJs("
        $(document).ready(function(){
                $('.test-subject').on('click',function(e){
                        e.preventDefault();
                        var subid =  $(this).attr('id');
                        $.ajax({
                             url:baseurl+'testpapers/load-test-chapters',
                             data:{'subid':subid},
                             type:'POST',
                             beforeSend:function(){
                                $('#accordion').html('<p>Loading.....wait a second</p>');
                             },
                             success:function(data){
                                $('#accordion').html(data);
                             },
                             error:function(){
                             }


                        })


                });
        });
        ");

