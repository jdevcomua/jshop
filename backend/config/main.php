<?php

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')

);

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'language' => 'ru',
    'modules' => [
        'datecontrol' =>  [
            'class' => '\kartik\datecontrol\Module'
        ],
        'users' => [
            'class' => 'budyaga\users\Module',
            //'userPhotoUrl' => 'http://example.com/uploads/user/photo',
            //'userPhotoPath' => '@www/web/uploads/user/photo'
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-admin',
        ],
        'urlHelper' => [
            'class' => 'common\components\UrlHelper',
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
            'enableStrictParsing' => false,
            'rules' => [
                '<language:(ru|en)>/'=>'site/index',
                '<language:(ru|en)>/category/<id:\d+>' => 'item-cat/view',
                '<language:(ru|en)>/category/<action:\w+>/<id:\d+>' => 'item-cat/<action>',
                '<language:(ru|en)>/category/<action:\w+>' => 'item-cat/<action>',
                '<language:(ru|en)>/category' => 'item-cat/index',
                '<language:(ru|en)>/<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<language:(ru|en)>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<language:(ru|en)>/<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                '<language:(ru|en)>/<controller:\w+>' => '<controller>/index',
                '<language:(ru|en)>/<module>/<controller>/<action>'=>'<module>/<controller>/<action>',
                '<language:(ru|en)>/<module>/<controller>'=>'<module>/<controller>/index',
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
        'allowedIPs' => ['*']
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*']
    ];
}

return $config;