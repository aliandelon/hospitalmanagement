<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class Login2Asset extends AssetBundle {
       

        public $basePath = '@webroot';
        public $baseUrl = '@web';
        public $css = [
            'login2/css/style.css',
            '//fonts.googleapis.com/css?family=Poiret+One&amp;subset=cyrillic,latin-ext',
            // 'login/fonts/iconic/css/material-design-iconic-font.min.css',
            // 'login/vendor/animate/animate.css',
            // 'login/vendor/css-hamburgers/hamburgers.min.css',
            // 'login/vendor/animsition/css/animsition.min.css',
            // 'login/vendor/select2/select2.min.css',
            // 'login/css/util.css',
            // 'login/css/main.css',
        ];
        public $js = [
            // 'login/vendor/jquery/jquery-3.2.1.min.js',
            // 'login/vendor/animsition/js/animsition.min.js',
            // 'login/vendor/bootstrap/js/popper.js',
            // 'login/vendor/bootstrap/js/bootstrap.min.js',
            // 'login/vendor/select2/select2.min.js',
            // 'login/vendor/daterangepicker/moment.min.js',
            // 'login/vendor/countdowntime/countdowntime.js',
            // 'login/js/main.js',
        ];
        public $depends = [
            'yii\web\YiiAsset',
            'yii\bootstrap\BootstrapAsset',
        ];

}
