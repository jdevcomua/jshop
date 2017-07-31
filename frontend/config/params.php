<?php

use common\components\Theme;

return [
    'adminEmail'    => 'admin@example.com',
    'theme'         => Theme::TEMPLATE_BASIC,
    'themeParams' => [
        Theme::PARAM_ITEMS_ON_FIRST_PAGE => 12,
        Theme::PARAM_ITEMS_ON_CATALOG_PAGE => 18,
    ],
];
