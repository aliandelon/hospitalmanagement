<?php

$params = array_merge(
        require(__DIR__ . '/../../common/config/params.php'), require(__DIR__ . '/../../common/config/params-local.php'), require(__DIR__ . '/params.php'), require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'class' => 'common\components\Request',
            'web' => '/frontend/web',
        ],
        'uploadFile' => [
            'class' => 'common\components\UploadFile',
        ],
        'mailer ' => [
            'class' => 'yii\swiftmailer\Mailer ',
            'viewPath' => '@common/mail ',
            'useFileTransport' => false, //set this property to false to send mails to real email addresses
            //comment the following array to send mail using php's mail function
            'transport' => [
                    'class' => 'Swift_SmtpTransport',
                    'host' => 'smtp.gmail.com',
                    'username' => 'mastermbbslearn@gmail.com',
                    'password' => 'qouzbthglwbopfgi',
                    'port' => '587',
                    'encryption' => 'tls',
                                ],
        ],
        'user' => [
            'identityClass' => 'common\models\Login',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        // 'parent' => [
        //     'class' => 'yii\web\User',
        //     'identityClass' => 'frontend\models\parents',
        //     'enableAutoLogin' => true,
        //     'loginUrl' => 'site/parent-login',
        //     'identityCookie' => [
        //         'name' => '_parent',
        //         'httpOnly' => true,
        //     ]
        // ],
        'session' => [
// this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'studentsLog' => [
            'class' => 'common\components\StudentsLoging',
        ],
    ],
    'params' => $params,
];

