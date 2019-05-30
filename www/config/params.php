<?php
use common\components\Theme;

return [
    'adminEmail'    => 'lordweyder333@gmail.com',
    'orderEmail'    => 'admin@example.com',
    'fbAppId' => '1278586458955080',
    'fbSecretKey' => '9025f7e15e75980534f81a9dcbacd121',
    'theme'         => Theme::TEMPLATE_BABYSHOP,
    'themeParams' => [
        Theme::PARAM_ITEMS_ON_FIRST_PAGE => 12,
        Theme::PARAM_ITEMS_ON_CATALOG_PAGE_18 => 18,
        Theme::PARAM_ITEMS_ON_CATALOG_PAGE_12 => 12,
    ],
];
