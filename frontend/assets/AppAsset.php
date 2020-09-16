<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle {

        public $basePath = '@webroot';
        public $baseUrl = '@web';
        public $css = [

           
            'https://fonts.googleapis.com/icon?family=Material+Icons',
            'css/bootstrap.min.css',
            'css/font-awesome.min.css',
            'css/style.css',
        ];
        public $js = [
            // 'js/jquery-3.2.1.min.js',
            'js/jquery-3.2.1.min.js',
            'js/popper.min.js',
            'js/bootstrap.min.js',
            'js/jquery.slimscroll.js',
            'js/chart.bundle.js',
            'js/chart.js',
            'js/app.js',
           
        ];
        // public $video = [
        //     'video/images',
        //     'video/vid.mp4'
        // ];
        public $depends = [
            // 'yii\web\YiiAsset',
            // 'yii\bootstrap\BootstrapAsset',
        ];

}
