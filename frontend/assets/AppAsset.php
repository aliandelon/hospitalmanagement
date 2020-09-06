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

            'http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css',
            'css/simpleMobileMenu.css',
            'https://fonts.googleapis.com/css?family=PT+Sans:400,400italic,700',
            'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css',
            'css/style.css',
            'css/animate.min.css',
            'css/slick.css',
            'css/slick-theme.css',
            'css/croppie.css',
            'css/component.css',
            'css/style-2.css'
                //'css/dependent-dropdown.min.css',
        ];
        public $js = [
            'js/bootstrap.js',
            'js/slick.min.js',
            'js/simpleMobileMenu.js',
            'js/modernizr.custom.js',
            'js/SmoothScroll.min.js',
            // 'js/dependent-dropdown.min.js',
            'js/croppie.js',
            'js/common.js',
        ];
        public $video = [
            'video/images',
            'video/vid.mp4'
        ];
        public $depends = [
            'yii\web\YiiAsset',
            'yii\bootstrap\BootstrapAsset',
        ];

}
