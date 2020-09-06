<?php

use yii\widgets\ListView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
?>
<?= $this->render('_topSubMenu'); ?>

<section class="allposts">
    <div class="container">
        <div class="row">
            <div class="col-md-8 viewpost">
                <div class="posted">
                    <h6><?= $question->title ? $question->title . ',' : "" ?></h6>
                    <?= $question->content ? $question->content : "NO CONTENT" ?>

                    <h6>Answers</h6>
                    <div class="answer-main">
                        <?php \yii\widgets\Pjax::begin(['timeout' => 5000, 'id' => 'answer-listview-div']); ?>
                        <?=
                        ListView::widget([
                            'dataProvider' => $question->loadAnswers($question->id),
                            'itemView' => '_answers',
                            'summary' => '',
                            'emptyText' => '--Be the first person answer this question--'
                        ]);
                        ?>
                        <?php \yii\widgets\Pjax::end(); ?>
                    </div>
                    <?php
                    if (isset($question->content) && $question->content != "") {
                            ?>
                            <div id="comment-add">
                                <?php
                                $form = ActiveForm::begin([
                                            'action' => 'question-answer/create',
                                            'id' => 'fourmComments-forms',
                                ]);
                                ?>

                                <?=
                                $form->field($forumnsComts, 'answer')->widget(CKEditor::className(), [
                                    'options' => ['rows' => 6, 'class' => 'form-controlv'],
                                    'preset' => 'basic'
                                ])->label('Your answer:')
                                ?>

                                <?= $form->field($forumnsComts, 'question_id')->hiddenInput(['value' => ($question->id) ? $question->id : ''])->label(false) ?>
                                <div class="form-group">
                                    <?= Html::submitButton($forumnsComts->isNewRecord ? 'Post' : 'Update', ['id' => 'commentpost', 'class' => $forumnsComts->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                                </div>

                                <?php ActiveForm::end(); ?>
                            </div>
                    <?php } ?>
                </div>
            </div>

            <div class="col-md-4 chapterz"> <!-- Related Post -->
                <div class="answerk">
                    <h6>Related Posts</h6>
                    <?=
                    ListView::widget([
                        'dataProvider' => $question->loadPost($question->topic_id),
                        'itemView' => '_postRelated',
                        'summary' => '',
                    ]);
                    ?>

                </div>
            </div>
        </div>
    </div>
</section>


<?php
$this->registerJs(
        "$('#fourmComments-forms').on('beforeSubmit', function(e) {
                var form = $(this);
                var formData = form.serialize();
                $.ajax({
                                url: baseurl + 'forums-answers/create',
                                 type: form.attr('method'),
                                 data: formData,
                                 success: function (data) {
                                if(data.response=='success') {
                                       $.pjax.reload({container:'#answer-listview-div'});
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
