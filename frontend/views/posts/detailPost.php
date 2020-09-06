<?php

use yii\helpers\Url;
use yii\widgets\ListView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use yii\widgets\Pjax;


$this->title =  "mastermbbs post";
?>
<?= $this->render('_topSubMenu'); ?>
<section class="new-list">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="post-1">
                    <img class="img-responsive" src="<?= Url::base() . '/images/list.jpg' ?>">
                </div>
                <div class="post-2">
                    <h1> <?= $post->cb0->first_name ? $post->cb0->first_name : " " ?></h1>
                    <p><?= $post->cb0->college ? $post->cb0->college : " " ?></p>
                    <p><?= $post->cb0->mbbs_year ? $post->cb0->mbbs_year : " " ?></p>
                </div>


            </div>
        </div>

    </div>
</section>



<section class="allposts">
    <div class="container">
        <div class="row">
            <div class="col-md-8 viewpost">

                <div class="posted">
                    <h6><?= $post->heading ? $post->heading . ',' : "" ?></h6>
                    <?= $post->con_text ? $post->con_text : "NO CONTENT" ?>

                    <?php
                    if (isset($post->con_text) && $post->con_text != "") {
                            ?>
                            <div id="comment-add">
                                <?php
                                $form = ActiveForm::begin([
                                            'action' => 'post-comments/create',
                                            'id' => 'comments-form',
                                ]);
                                ?>
                                <?=
						            $form->field($newComments, 'comment')->widget(CKEditor::className(), [
						                'options' => ['rows' => 6, 'class' => 'form-controlv'],
						                'preset' => 'basic'
						            ])->label('Leave a Comment:')
						            ?>
                                
                                <?= $form->field($newComments, 'post_id')->hiddenInput(['value' => ($post->post_id) ? $post->post_id : ''])->label(false) ?>
                                <div class="form-group">
                                    <?= Html::submitButton($newComments->isNewRecord ? 'Post' : 'Update', ['id' => 'commentpost', 'class' => $newComments->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                                </div>

                                <?php ActiveForm::end(); ?>
                            </div>
                    <?php } ?>
                </div>
            </div>

            <div class="col-md-4 chapterz"> <!-- Related Post -->
                <div class="answerk">
                    <h6>Related Posts</h6>
                    <?php Pjax::begin(['id' => 'comments-listview-related']); ?>
                    <?=
                    ListView::widget([
                        'dataProvider' => $rpost,
                        'itemView' => '_postRelated',
                        'summary' => '',
                    ]);
                    ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mbbs-answer">  <!-- Comments -->
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-8 col-xs-12 ">
                <h6>Comments</h6>
                <div class="answer-main">
                    <?php \yii\widgets\Pjax::begin(['id' => 'comments-listview-div']); ?>
                    <?=
                    ListView::widget([
                        'dataProvider' => $post->loadComments($post->post_id),
                        'itemView' => '_postComments',
                        'summary' => '',
                        'emptyText' => '--Be the first person comment this post--'
                    ]);
                    ?>
                    <?php \yii\widgets\Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$this->registerJs(
        "$('#comments-form').on('beforeSubmit', function(e) {
				var postid = $('#postcomments-post_id').val();				
                var form = $(this);
                var formData = form.serialize();
                $.ajax({
                                url: baseurl + 'post-comments/create',
                                 type: form.attr('method'),
                                 data: formData,
                                 success: function (data) {				
		
                                if(data.response=='success') { 			
									$('#comments-form')[0].reset();
									$.pjax.reload({container:'#comments-listview-div'});
                                	}if(data.response=='error') {
                                        alert('error');
                                }
                                        return false;

                                },
                                 error: function () {
                                alert('Something went wrong');
                                }
                               });
                        }).on('submit', function(e){
                        e.preventDefault();
                });
");

