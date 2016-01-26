<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\MemCache',
            'servers' => [
                [
                    'host' => 'localhost',
                    'port' => 11211,
                ],
            ],
            'useMemcached' => true,
            'serializer' => false,
            'options' => [
                \Memcached::OPT_COMPRESSION => false,
            ],
        ],
        'session' => [
            'class'=>'yii\web\CacheSession',
            'cache'=>'cache',
        ],
    ],
];
