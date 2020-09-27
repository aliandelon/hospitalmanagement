<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class Login3Asset extends AssetBundle {
       

        public $basePath = '@webroot';
        public $baseUrl = '@web';
        public $css = [
            'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css',
            'https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500&display=swap',
         
        ];
        public $js = [
            'https://code.jquery.com/jquery-3.3.1.slim.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js',
            'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js',
          
        ];
        public $depends = [
            // 'yii\web\YiiAsset',
            // 'yii\bootstrap\BootstrapAsset',
        ];

}
