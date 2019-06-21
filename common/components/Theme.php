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

    const PARAM_ITEMS_SORT_DATE = 'дата';
    const PARAM_ITEMS_SORT_ASC = 'по возрастанию';
    const PARAM_ITEMS_SORT_DESC = 'desc';
    const PARAM_ITEMS_SORT_NEW = 'новый';
    const PARAM_ITEMS_SORT_RATING = 'рейтинг';
    const PARAM_ITEMS_SORT_TOP = 'лучший';
    const PARAM_ITEMS_SORT_PROM = 'промо';

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
            Theme::PARAM_ITEMS_SORT_DATE => Theme::PARAM_ITEMS_SORT_DATE,
            Theme::PARAM_ITEMS_SORT_ASC => Theme::PARAM_ITEMS_SORT_ASC,
            Theme::PARAM_ITEMS_SORT_DESC => Theme::PARAM_ITEMS_SORT_DESC,
            Theme::PARAM_ITEMS_SORT_NEW => Theme::PARAM_ITEMS_SORT_NEW,
            Theme::PARAM_ITEMS_SORT_RATING => Theme::PARAM_ITEMS_SORT_RATING,
            Theme::PARAM_ITEMS_SORT_TOP => Theme::PARAM_ITEMS_SORT_TOP,
            Theme::PARAM_ITEMS_SORT_PROM => Theme::PARAM_ITEMS_SORT_PROM,
        ];
    }
}