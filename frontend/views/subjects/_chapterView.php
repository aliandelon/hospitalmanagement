
<div class="col-md-9 col-sm-12 col-xs-12 primes">
    <div class="sixty">
        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <?php
                if (count($defaultsubject) > 0) {
                        foreach ($defaultsubject as $chapter) {
                                ?>
                                <div class="panel-heading">
                                    <a data-toggle="collapse"  class = "topics_list_subjects"  id = "topics_list_subjects_<?= $chapter['chapter_id'] ?>" sub = "<?= $chapter['sub_id'] ?>" data-parent="#accordion" href="<?= $chapter['chapter_name'] ?>">
                                        <h4 class="panel-title">
                                            <?= ($chapter['chapter_name']) ? $chapter['chapter_name'] : ""; ?>
                                            <span class="mans">start<i class="fa rights fa-angle-right"></i></span>
                                        </h4>
                                    </a>
                                    <div id="collapse<?= $chapter['chapter_id'] ?>" class="panel-collapse collapse">
                                    </div>

                                </div>
                        <?php }
                } else {
                        ?>
                        <div class="panel-heading">
                            <img class="center-block" src="<?= \yii\helpers\Url::base() . '/images/check-back-soon.gif' ?>">
                        </div>

                <?php }
                ?>
            </div>
        </div>
    </div>
</div>
<?php
$this->registerJs(
        "$('.topics_list_subjects').on('click', function(e){
                e.preventDefault();
                var chapterid = $(this).attr('id');
                var idarray = chapterid.split('_');
                var divid = idarray[idarray.length-1];
                $.ajax({
                        url : baseurl + 'chapters/list-topics-by-chapter',
                        type : 'POST',
                        data : {'chapter' : divid},
                        success : function(data) {
                                $('.collapse').hide();
                                $('#collapse'+divid).html(data).show();
                         return false;
                         }
                         });
                         return false;
                         });
                     ");
