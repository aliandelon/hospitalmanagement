<?php 
use yii\widgets\ListView;
?>
<?=
ListView::widget([
		'dataProvider' => $post->loadComments($post->post_id),
		'itemView' => '_postComments',
		'summary' => '',
		'emptyText' => '--Be the first person comment this post--'
]);
?>