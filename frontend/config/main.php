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
    'name' => 'Интернет-магазин Active',
    'controllerNamespace' => 'frontend\controllers',
    'bootstrap' => ['log'],
    'language' => 'ru',
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
            'rules' => [
                '<language:(ru|en)>/'=>'site/index',
                '<language:(ru|en)>/site'=>'site/index',
                '<language:(ru|en)>/site/index'=>'site/index',
                '<language:(ru|en)>/search'=>'site/search',
                '<language:(ru|en)>/site/img/*'=>'img/*',
                '<language:(ru|en)>/cart'=>'cart/index',
                '<language:(ru|en)>/cart/order'=>'cart/order',
                '<language:(ru|en)>/cart/delete'=>'cart/delete',
                '<language:(ru|en)>/cart/ajax'=>'cart/ajax',
                '<language:(ru|en)>/cart/add'=>'cart/add',
                '<language:(ru|en)>/cart/change'=>'cart/change',
                '<language:(ru|en)>/item'=>'item/item',
                '<language:(ru|en)>/item/<id>'=>'item/item',
                '<language:(ru|en)>/item/item'=>'item/item',
                '<language:(ru|en)>/promotion/<id>'=>'site/promotion',
                '<language:(ru|en)>/promotions'=>'site/promotions',
                '<language:(ru|en)>/category/<id>'=>'site/category',
                '<language:(ru|en)>/site/category/<id>'=>'site/category',
                '<language:(ru|en)>/site/category'=>'site/category',
                '<language:(ru|en)>/login'=>'user/login',
                '<language:(ru|en)>/user/login'=>'user/login',
                '<language:(ru|en)>/logout'=>'user/logout',
                '<language:(ru|en)>/register'=>'user/register',
                '<language:(ru|en)>/profile'=>'user/profile',
                '<language:(ru|en)>/wishlist'=>'user/wishlist',
                '<language:(ru|en)>/user/wishlist'=>'user/wishlist',
                '<language:(ru|en)>/user/profile'=>'user/profile',
                '<language:(ru|en)>/forgot-password'=>'user/forgot-password',
                '<language:(ru|en)>/reset-password'=>'user/reset-password',
                '<language:(ru|en)>/user/vk-auth'=>'user/vk-auth',
                '<language:(ru|en)>/user/facebook-auth'=>'user/facebook-auth',
                '<language:(ru|en)>/compare'=>'compare/compare',
                '<language:(ru|en)>/compare/compare'=>'compare/compare',
                '<language:(ru|en)><controller>/<action>'=>'<controller>/<action>',
            ],
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@frontend/messages',
                    'sourceLanguage' => 'ru',
                    'fileMap' => [
                        'app' => 'index.php',
                        'app/error' => 'error.php',
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