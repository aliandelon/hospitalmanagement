<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class DashboardAsset extends AssetBundle {
        

        public $basePath = '@webroot';
        public $baseUrl = '@web';
        public $css = [
            'https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900',
            'css/bootstrap.min.css',
            'css/font-awesome.min.css',
            'css/owl.carousel.css',
            'css/owl.theme.css',
            'css/owl.transitions.css',
            'css/animate.css',
            'css/normalize.css',
            'css/meanmenu.min.css',
            'css/main.css',
            'css/educate-custon-icon.css',
            'css/morrisjs/morris.css',
            'css/scrollbar/jquery.mCustomScrollbar.min.css',
            'css/metisMenu/metisMenu.min.css',
            'css/metisMenu/metisMenu-vertical.css',
            'css/calendar/fullcalendar.min.css',
            'css/calendar/fullcalendar.print.min.css',
            'css/style.css',
            'css/responsive.css',
            'css/developer.css'
        ];
        public $js = [
            // 'js/vendor/jquery-1.12.4.min.js',
            'js/bootstrap.min.js',
            'js/wow.min.js',
            'js/jquery-price-slider.js',
            'js/jquery.meanmenu.js',
            'js/owl.carousel.min.js',
            'js/jquery.sticky.js',
            'js/jquery.scrollUp.min.js',
            'js/counterup/jquery.counterup.min.js',
            'js/counterup/waypoints.min.js',
            'js/counterup/counterup-active.js',
            'js/scrollbar/jquery.mCustomScrollbar.concat.min.js',
            'js/scrollbar/mCustomScrollbar-active.js',
            'js/metisMenu/metisMenu.min.js',
            'js/metisMenu/metisMenu-active.js',
            'js/morrisjs/raphael-min.js',
            'js/morrisjs/morris.js',
            'js/morrisjs/morris-active.js',
            'js/sparkline/jquery.sparkline.min.js',
            'js/sparkline/jquery.charts-sparkline.js',
            'js/sparkline/sparkline-active.js',
            'js/calendar/moment.min.js',
            'js/calendar/fullcalendar.min.js',
            'js/calendar/fullcalendar-active.js',
            'js/plugins.js',
            'js/main.js',
            'https://unpkg.com/sweetalert/dist/sweetalert.min.js',
            // 'js/tawk-chat.js',
        ];
        public $depends = [
            'yii\web\YiiAsset',
            'yii\bootstrap\BootstrapAsset',
            // 'yii\bootstrap\BootstrapPluginAsset',
        ];

}
