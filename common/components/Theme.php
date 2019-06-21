<?php


namespace common\components;

use yii\base\Object;

class Theme extends Object
{
    const TEMPLATE_BASIC    = 'basic';
    const TEMPLATE_OPENCART = 'opencart';
    const TEMPLATE_BABYSHOP = 'babyshop';

    const PARAM_ITEMS_ON_FIRST_PAGE = 1;
    const PARAM_ITEMS_ON_CATALOG_PAGE_12 = 2;
    const PARAM_ITEMS_ON_CATALOG_PAGE_18 = 3;

    const PARAM_ITEMS_SORT_DATE = 'date';
    const PARAM_ITEMS_SORT_ASC = 'asc';
    const PARAM_ITEMS_SORT_DESC = 'desc';
    const PARAM_ITEMS_SORT_NEW = 'new';
    const PARAM_ITEMS_SORT_RATING = 'rating';
    const PARAM_ITEMS_SORT_TOP = 'top';
    const PARAM_ITEMS_SORT_PROM = 'promo';

    public static function getParam($name)
    {
        return \Yii::$app->params['themeParams'][$name];
    }

    public static function getPagination($current)
    {
        $array = [
            Theme::PARAM_ITEMS_ON_CATALOG_PAGE_12 => Theme::getParam(Theme::PARAM_ITEMS_ON_CATALOG_PAGE_12),
            Theme::PARAM_ITEMS_ON_CATALOG_PAGE_18 => Theme::getParam(Theme::PARAM_ITEMS_ON_CATALOG_PAGE_18),
        ];
        unset($array[$current]);
        $res = '';
        foreach ($array as $key => $line) {
            $res .= '<li><a href="" data-pjax = true onclick="setPerPage('. $key.')">' . $line . '</a></li>';
        }
        return $res;
    }

    public static function getSort($current)
    {
        $array = Theme::getSortName();
        unset($array[$current]);
        $res = '';
        foreach ($array as $key => $line) {
            $res .= '<li><a href="" data-pjax = true onclick="setSort(\''. $key.'\')">' . $line . '</a></li>';
        }
        return $res;
    }


    public static function getSortName()
    {
        return [
            Theme::PARAM_ITEMS_SORT_DATE => \Yii::t('app','date'),
            Theme::PARAM_ITEMS_SORT_ASC => \Yii::t('app','asc'),
            Theme::PARAM_ITEMS_SORT_DESC => \Yii::t('app','desc'),
            Theme::PARAM_ITEMS_SORT_NEW => \Yii::t('app','new'),
            Theme::PARAM_ITEMS_SORT_RATING => \Yii::t('app','rating'),
            Theme::PARAM_ITEMS_SORT_TOP => \Yii::t('app','top'),
            Theme::PARAM_ITEMS_SORT_PROM => \Yii::t('app','promo'),
        ];
    }
}