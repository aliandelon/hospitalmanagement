<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class LoginAsset extends AssetBundle {
       

        public $basePath = '@webroot';
        public $baseUrl = '@web';
        public $css = [
            'login/vendor/bootstrap/css/bootstrap.min.css',
            'login/fonts/font-awesome-4.7.0/css/font-awesome.min.css',
            'login/vendor/animate/animate.css',
            'login/vendor/css-hamburgers/hamburgers.min.css',
            'login/vendor/select2/select2.min.css',
            'login/css/util.css',
            'login/css/main.css',
        ];
        public $js = [
            'login/vendor/jquery/jquery-3.2.1.min.js',
            'login/vendor/bootstrap/js/popper.js',
            'login/vendor/bootstrap/js/bootstrap.min.js',
            'login/vendor/select2/select2.min.js',
            'login/vendor/tilt/tilt.jquery.min.js',
        ];
        public $depends = [
            'yii\web\YiiAsset',
            'yii\bootstrap\BootstrapAsset',
        ];

}
