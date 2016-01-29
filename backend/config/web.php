<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'language' => 'ru',
    'modules' => [
        'datecontrol' =>  [
            'class' => '\kartik\datecontrol\Module'
        ]
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'KZ0u56ukNp3p5W82jnpJmisKu8wDUDdY',
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
            'rules' => [
                '<language:(ru|en)>/'=>'site/index',
                '<language:(ru|en)>/site/index'=>'site/index',

                '<language:(ru|en)>/item'=>'item/index',
                '<language:(ru|en)>/item/index'=>'item/index',
                '<language:(ru|en)>/item/update'=>'item/update',
                '<language:(ru|en)>/item/create'=>'item/create',
                '<language:(ru|en)>/item/view'=>'item/view',
                '<language:(ru|en)>/item/<id:\d+>'=>'item/view',
                '<language:(ru|en)>/item/delete'=>'item/delete',
                '<language:(ru|en)>/item/characteristics'=>'item/characteristics',
                '<language:(ru|en)>/item/update-characteristics'=>'item/update-characteristics',

                '<language:(ru|en)>/item-cat'=>'item-cat/index',
                '<language:(ru|en)>/item-cat/index'=>'item-cat/index',
                '<language:(ru|en)>/item-cat/group'=>'item-cat/group',
                '<language:(ru|en)>/item-cat/update'=>'item-cat/update',
                '<language:(ru|en)>/item-cat/create'=>'item-cat/create',
                '<language:(ru|en)>/item-cat/view'=>'item-cat/view',

                '<language:(ru|en)>/characteristic/index'=>'characteristic/index',
                '<language:(ru|en)>/characteristic'=>'characteristic/index',
                '<language:(ru|en)>/characteristic/update'=>'characteristic/update',
                '<language:(ru|en)>/characteristic/create'=>'characteristic/create',
                '<language:(ru|en)>/characteristic/view'=>'characteristic/view',
                '<language:(ru|en)>/characteristic/group'=>'characteristic/group',
                '<language:(ru|en)>/characteristic/delete'=>'characteristic/delete',

                '<language:(ru|en)>/vote/index'=>'vote/index',
                '<language:(ru|en)>/vote'=>'vote/index',
                '<language:(ru|en)>/vote/update'=>'vote/update',
                '<language:(ru|en)>/vote/create'=>'vote/create',
                '<language:(ru|en)>/vote/view'=>'vote/view',
                '<language:(ru|en)>/vote/group'=>'vote/group',
                '<language:(ru|en)>/vote/delete'=>'vote/delete',

                '<language:(ru|en)>/user/index'=>'user/index',
                '<language:(ru|en)>/user'=>'user/index',
                '<language:(ru|en)>/user/update'=>'user/update',
                '<language:(ru|en)>/user/create'=>'user/create',
                '<language:(ru|en)>/user/view'=>'user/view',

                '<language:(ru|en)>/orders/index'=>'orders/index',
                '<language:(ru|en)>/orders'=>'orders/index',
                '<language:(ru|en)>/orders/update'=>'orders/update',
                '<language:(ru|en)>/orders/create'=>'orders/create',
                '<language:(ru|en)>/orders/view'=>'orders/view',
                '<language:(ru|en)>/orders/group'=>'orders/group',

                '<language:(ru|en)>/order-item/index'=>'order-item/index',
                '<language:(ru|en)>/order-item'=>'order-item/index',
                '<language:(ru|en)>/order-item/update'=>'order-item/update',
                '<language:(ru|en)>/order-item/create'=>'order-item/create',
                '<language:(ru|en)>/order-item/view'=>'order-item/view',

                '<language:(ru|en)>/stock'=>'stock/index',
                '<language:(ru|en)>/stock/index'=>'stock/index',
                '<language:(ru|en)>/stock/group'=>'stock/group',
                '<language:(ru|en)>/stock/update'=>'stock/update',
                '<language:(ru|en)>/stock/create'=>'stock/create',
                '<language:(ru|en)>/stock/view'=>'stock/view',

                '<language:(ru|en)>/kit'=>'kit/index',
                '<language:(ru|en)>/kit/index'=>'kit/index',
                '<language:(ru|en)>/kit/group'=>'kit/group',
                '<language:(ru|en)>/kit/update'=>'kit/update',
                '<language:(ru|en)>/kit/create'=>'kit/create',
                '<language:(ru|en)>/kit/view'=>'kit/view',

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
