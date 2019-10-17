<?php
namespace www\filters;

class ItemsFilter
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
}