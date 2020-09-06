<section class="books">
        <div class="container">
                <div class="row">
                        <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                                <h2>We Recommend</h2>

                                <?php foreach ($we_recommends as $we_recommend) { ?>
                                        <div class="book-box">
                                                <figure>
                                                        <?php if ($we_recommend->link != ""): ?>
                                                                <a href="<?php echo $we_recommend->link; ?>">  <img src="<?= Yii::$app->request->baseUrl ?>/uploads/werecommend/<?php echo $we_recommend->id ?>/<?php echo $we_recommend->id ?>.<?php echo $we_recommend->cover_image ?> " alt="no-image" width="100%" height="100%"></a>
                                                        <?php else: ?>
                                                                <img src="<?= Yii::$app->request->baseUrl ?>/uploads/werecommend/<?php echo $we_recommend->id ?>/<?php echo $we_recommend->id ?>.<?php echo $we_recommend->cover_image ?> " alt="no-image" width="100%" height="100%">
                                                        <?php endif; ?>
                                                </figure>
                                                <figcaption>
                                                        <h3><?php echo $we_recommend->title; ?></h3>
                                                        <p><?php echo $we_recommend->short_description ?></p>
                                                </figcaption>
                                        </div>
                                <?php } ?>
                        </div>
                </div>
        </div>
</section>