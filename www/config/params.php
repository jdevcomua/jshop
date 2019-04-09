<?php
use common\components\Theme;

return [
    'adminEmail'    => 'admin@example.com',
    'theme'         => Theme::TEMPLATE_BABYSHOP,
    'themeParams' => [
        Theme::PARAM_ITEMS_ON_FIRST_PAGE => 12,
        Theme::PARAM_ITEMS_ON_CATALOG_PAGE_18 => 18,
        Theme::PARAM_ITEMS_ON_CATALOG_PAGE_12 => 12,
    ],
];
