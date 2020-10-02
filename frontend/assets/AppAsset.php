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
            'css/fullcalendar.min.css',
            'css/select2.min.css',
            'css/bootstrap-datetimepicker.min.css',
            'css/package.css',
            
            //'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css',
            // adding glyficons
           // "//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css"


            //data live search for dropdown
            // 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css',
            // 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.css'
        ];
        public $js = [
            // 'js/jquery-3.2.1.min.js',
            'js/popper.min.js',
            'js/bootstrap.min.js',
            'js/jquery.slimscroll.js',
            'js/chart.bundle.js',
            // 'js/select2.min.js',
            'js/moment.min.js',
            // 'js/jquery-ui.min.html',
            'js/fullcalendar.min.js',
            'js/jquery.fullcalendar.js',
            'js/bootstrap-datetimepicker.min.js',
            'js/app.js',
            //data live search for dropdown
            // 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js',
            // 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js',
            '//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js',
            'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js',
            //'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.js',
            //'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js'
        ];
        // public $video = [
        //     'video/images',
        //     'video/vid.mp4'
        // ];
        public $depends = [
            'yii\web\YiiAsset',
            // 'yii\bootstrap\BootstrapAsset',
        ];

}
