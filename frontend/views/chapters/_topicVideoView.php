<?php

use yii\widgets\ListView;

$rpost = new \frontend\models\PostsSearch();
?>

<div class="row">
    <div class="col-xs-12 col-md-12 iframe_edit">
        <h1><?= ($topicDetails->topic) ? $topicDetails->topic : ""; ?></h1>
        <iframe id="player1" src="https://player.vimeo.com/video/<?= $topicDetails->video_file ?>?api=1&player_id=player1" width="100%" frameborder="0"
                webkitallowfullscreen mozallowfullscreen allowfullscreen>
        </iframe>
    </div>


    <div class="col-md-12">
        <div class="answerk">
            <h6>Relevant  points/questions</h6>
            <?= $topicDetails->content  ?>
            
            <?php
            
           /* echo ListView::widget([
                'dataProvider' => $rpost->relatedPost($topicDetails->topic_id),
                'itemView' => '_topicPostView',
                'summary' => '',
                'emptyText' => 'updating soon',
            ]);*/
            ?>

        </div>
    </div>
</div>



<!--<div class="row">
    <div class="col-md-12" id="topic_content">
<?= ($topicDetails->content) ? $topicDetails->content : " We are updating the content soon!.."; ?>
    </div>
</div>-->

<?php
$this->registerjs("
$(function(){
    var iframe = document.querySelector('iframe');
    var player = new Vimeo.Player(iframe);
    player.on('play', function() {
       // alert('played the video!');
    });

    player.on('pause', function() {
        player.getCurrentTime().then(function(seconds) {
          //       alert(seconds);
        }).catch(function(error) {
        // an error occurred
        });
    });



});
");


