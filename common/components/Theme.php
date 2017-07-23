<?php


namespace common\components;

use yii\base\Object;

class Theme extends Object
{
    const TEMPLATE_BASIC    = 'basic';
    const TEMPLATE_OPENCART = 'opencart';
    const TEMPLATE_BABYSHOP = 'babyshop';

    const PARAM_ITEMS_ON_FIRST_PAGE = 1;

    public static function getParam($name)
    {
        return \Yii::$app->params['themeParams'][$name];
    }
}