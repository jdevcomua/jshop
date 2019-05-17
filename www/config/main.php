<?php

use common\components\Theme;

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')

);

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'name' => 'SDelivery',
    'controllerNamespace' => 'www\controllers',
    'bootstrap' => ['log'],
    'language' => 'en',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'KZ0u56ukNp3p5W82jnpJmisKu8wDUDdY',
        ],
        'cart' => [
            'class' => 'common\components\Cart',
        ],
        'compare' => [
            'class' => 'common\components\Compare',
        ],
        'urlHelper' => [
            'class' => 'common\components\UrlHelper',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                /*'<language:(ru|en)>/'=>'site/index',
                '<language:(ru|en)>/site'=>'site/index',
                '<language:(ru|en)>/search'=>'site/search',
                '<language:(ru|en)>/site/img/*'=>'img/*',
                '<language:(ru|en)>/cart'=>'cart/index',
                '<language:(ru|en)>/item/<id>'=>'item/item',
                '<language:(ru|en)>/promotion/<id>'=>'site/promotion',
                '<language:(ru|en)>/promotions'=>'site/promotions',
                '<language:(ru|en)>/category/<id>'=>'site/category',
                '<language:(ru|en)>/site/category/<id>'=>'site/category',
                '<language:(ru|en)>/login'=>'user/login',
                '<language:(ru|en)>/logout'=>'user/logout',
                '<language:(ru|en)>/register'=>'user/register',
                '<language:(ru|en)>/profile'=>'user/profile',
                '<language:(ru|en)>/wishlist'=>'user/wishlist',
                '<language:(ru|en)>/compare'=>'compare/compare',
                '<language:(ru|en)>/<controller>/<action>/<id>' => '<controller>/<action>',
                '<language:(ru|en)>/<controller>/<action>' => '<controller>/<action>',
                '<language:(ru|en)>/<controller>' => '<controller>/index',
                '<language:(ru|en)>/<module>/<controller>/<action>'=>'<module>/<controller>/<action>',
                '<language:(ru|en)>/<module>/<controller>'=>'<module>/<controller>/index',*/
                '/'=>'site/index',
                'site'=>'site/index',
                'search/<search>'=>'site/search',
                'search'=>'site/search',
                'site/img/*'=>'img/*',
                'cart'=>'cart/index',
                'item/quick-view'=>'item/quick-view',
                'item/<id>'=>'item/item',
                'promotion/<id>'=>'site/promotion',
                'promotions'=>'site/promotions',
                'category/<id>'=>'site/category',
                'site/category/<id>'=>'site/category',
                'login'=>'user/login',
                'logout'=>'user/logout',
                'register'=>'user/register',
                'profile'=>'user/profile',
                'change-password'=>'user/change-password',
                'orderlist'=>'user/orderlist',
                'dashboard'=>'user/dashboard',
                'wishlist'=>'user/wishlist',
                'reset-password'=>'user/reset-password',
                'compare'=>'compare/compare',
                '<controller>/<action>/<id>' => '<controller>/<action>',
                '<controller>/<action>' => '<controller>/<action>',
                '<controller>' => '<controller>/index',
                '<module>/<controller>/<action>'=>'<module>/<controller>/<action>',
                '<module>/<controller>'=>'<module>/<controller>/index',
            ],
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@www/messages',
                    'sourceLanguage' => 'en',
                    'fileMap' => [
                        'app'       => 'index.php',
                        'app/error' => 'error.php',
                        'app/model'     => 'model.php',
                    ],
                ],
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
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
        'view' => [
            'theme' => [
                'basePath' => '@app/themes/' . $params['theme'],
                'baseUrl' => '@web/themes/'. $params['theme'],
                'pathMap' => [
                    '@app/views'    => '@app/themes/' . $params['theme'] . '/views',
                    '@app/widgets'  => '@app/themes/' . $params['theme'] . '/widgets',
                ],
            ],
        ],
        'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => false,
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