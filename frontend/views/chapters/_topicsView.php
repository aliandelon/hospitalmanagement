<?php

use yii\widgets\ListView;

echo ListView::widget([
    'dataProvider' => $topics,
    'itemView' => '_topicsListView',
    'summary' => '',
    'emptyText' => 'Coming Soon',
]);
