<?php
namespace www\filters;

use yii\base\BaseObject;

class ItemsFilter extends BaseObject
{
    const FILTERS = [
        'listType',
        'page',
        'sort',
        'left',
        'right',
        'listType',
        'modalId',
    ];

    const R_FILTERS = [
        'manufacturer',
        'left',
        'right',
    ];

    const M_FILTER = 'manufacturer';
    const R_M_FILTER = 'removeOneManufacturer';
    const R_ALL_M_FILTER = 'removeManufacturer';

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
    const THEME_PARAMS= [
        ItemsFilter::PARAM_ITEMS_ON_FIRST_PAGE => 12,
        ItemsFilter::PARAM_ITEMS_ON_CATALOG_PAGE_18 => 18,
        ItemsFilter::PARAM_ITEMS_ON_CATALOG_PAGE_12 => 12,
    ];

    protected $data;


    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function addFilterData()
    {
        if(isset($this->data['currentCategoryId'])){
            $this->removeFilters();
        }else{
            $session = \Yii::$app->session;
            foreach (static::FILTERS as $filter){
                if(isset($this->data[$filter])){
                    $session->set($filter,$this->data[$filter]);
                }
            }

            if(isset($this->data[static::M_FILTER])){
                $manufacturer = $session->get(static::M_FILTER);
                if (!empty($manufacturer)){
                    $manufacturer[$this->data[static::M_FILTER]] = (int)$this->data[static::M_FILTER];
                    $session->set(static::M_FILTER,$manufacturer);
                }else{
                    $manufacturer = [];
                    $manufacturer[$this->data[static::M_FILTER]] = (int)$this->data[static::M_FILTER];
                    $session->set(static::M_FILTER,$manufacturer);
                }
            }

            if(isset($this->data[static::R_M_FILTER])){
                $manufacturer = $session->get(static::M_FILTER);
                if (!empty($manufacturer) && isset($manufacturer[$this->data[static::R_M_FILTER]])){
                    unset($manufacturer[$this->data[static::R_M_FILTER]]);
                    $session->set(static::M_FILTER,$manufacturer);
                }
            }

            if(isset($this->data[static::R_ALL_M_FILTER])){
                $session->remove(static::M_FILTER);
            }
        }
    }

    public function removeFilters(){
        $session = \Yii::$app->session;
        foreach (static::R_FILTERS as $filter){
            $session->remove($filter);
        }
    }

    public static function getParam($name)
    {
        if (isset(static::THEME_PARAMS[$name])){
            return static::THEME_PARAMS[$name];
        }else{
            return 18;
        }
    }

    public static function getPagination($current)
    {
        $array = [
            ItemsFilter::PARAM_ITEMS_ON_CATALOG_PAGE_12 => ItemsFilter::getParam(ItemsFilter::PARAM_ITEMS_ON_CATALOG_PAGE_12),
            ItemsFilter::PARAM_ITEMS_ON_CATALOG_PAGE_18 => ItemsFilter::getParam(ItemsFilter::PARAM_ITEMS_ON_CATALOG_PAGE_18),
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
        $array = ItemsFilter::getSortName();
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
            ItemsFilter::PARAM_ITEMS_SORT_DATE => \Yii::t('app','date'),
            ItemsFilter::PARAM_ITEMS_SORT_ASC => \Yii::t('app','asc'),
            ItemsFilter::PARAM_ITEMS_SORT_DESC => \Yii::t('app','desc'),
            ItemsFilter::PARAM_ITEMS_SORT_NEW => \Yii::t('app','new'),
            ItemsFilter::PARAM_ITEMS_SORT_RATING => \Yii::t('app','rating'),
            ItemsFilter::PARAM_ITEMS_SORT_TOP => \Yii::t('app','top'),
            ItemsFilter::PARAM_ITEMS_SORT_PROM => \Yii::t('app','promo'),
        ];
    }
}