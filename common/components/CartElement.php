<?php
/**
 * Created by PhpStorm.
 * User: umka
 * Date: 16.01.16
 * Time: 13:26
 */

namespace common\components;

use common\models\Item;

class CartElement
{

    /**
     * @var Item
     */
    public $model;

    public $count;

    /**
     * @return float
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @return CartAdd
     */
    public function getModel()
    {
        return $this->model;
    }

}