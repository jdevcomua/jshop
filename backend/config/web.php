<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'language' => 'ru',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'KZ0u56ukNp3p5W82jnpJmisKu8wDUDdY',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [

                '<language:(ru|en)>/'=>'site/index',
                '<language:(ru|en)>/item'=>'item/index',
                '<language:(ru|en)>/item/index'=>'item/index',
                '<language:(ru|en)>/item/update'=>'item/update',
                '<language:(ru|en)>/item/create'=>'item/create',
                '<language:(ru|en)>/item/view'=>'item/view',
                '<language:(ru|en)>/item-cat'=>'item-cat/index',
                '<language:(ru|en)>/item-cat/index'=>'item-cat/index',
                '<language:(ru|en)>/item-cat/update'=>'item-cat/update',
                '<language:(ru|en)>/item-cat/create'=>'item-cat/create',
                '<language:(ru|en)>/item-cat/view'=>'item-cat/view',
                '<language:(ru|en)>/characteristic/index'=>'characteristic/index',
                '<language:(ru|en)>/characteristic'=>'characteristic/index',
                '<language:(ru|en)>/characteristic/update'=>'characteristic/update',
                '<language:(ru|en)>/characteristic/create'=>'characteristic/create',
                '<language:(ru|en)>/characteristic/view'=>'characteristic/view',
                '<language:(ru|en)>/characteristic/group'=>'characteristic/group',
                '<language:(ru|en)>/user/index'=>'user/index',
                '<language:(ru|en)>/user'=>'user/index',
                '<language:(ru|en)>/user/update'=>'user/update',
                '<language:(ru|en)>/user/create'=>'user/create',
                '<language:(ru|en)>/user/view'=>'user/view',
                '<language:(ru|en)>/order-item/index'=>'order-item/index',
                '<language:(ru|en)>/order-item'=>'order-item/index',
                '<language:(ru|en)>/order-item/update'=>'order-item/update',
                '<language:(ru|en)>/order-item/create'=>'order-item/create',
                '<language:(ru|en)>/order-item/view'=>'order-item/view',
                '<language:(ru|en)><controller>/<action>'=>'<controller>/<action>',
            ],
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@backend/messages',
                    'sourceLanguage' => 'ru',
                    'fileMap' => [
                        'app' => 'index.php',
                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => [
                        'error', 'warning'
                    ],
                ],
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*']
    ];
}

return $config;
