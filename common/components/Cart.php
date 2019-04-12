<?php

namespace common\components;

use common\models\Kit;
use yii\base\Component;
use common\models\Item;
use common\models\OrderItem;
use Yii;

/**
 * Created by PhpStorm.
 * User: umo4ka
 * Date: 26.12.15
 * Time: 12:35
 */
class Cart extends Component
{

    public function init()
    {
        parent::init();
        if (empty(Yii::$app->session->get('cart'))) {
            Yii::$app->session->set('cart', []);
        }
    }

    /**
     * @return int count items in cart
     */
    public function getCount()
    {
        $sum = 0;
        foreach ($this->getArray() as $array) {
            $sum += $array['count'];
        }
        return $sum;
    }

    /**
     * @param CartAdd $item
     * @param int $count items to add
     */
    public function addItem(CartAdd $item, $count = 1)
    {
        $array = $this->getArray();
        if ($this->checkItem($item)) {
            $key = $this->getSubArrayKey($item);
            $array[$key]['count'] += $count;
        } else {
            $array[] = ['id' => $item->getId(),
                'type' => $item->getType(),
                'count' => $count];
        }
        Yii::$app->session['cart'] = $array;
    }

    /**
     * @param $item_id integer
     * @param $type
     * @param $count integer
     */
    public function setItem($item_id, $type, $count)
    {
        $array = $this->getArray();
        $array[$this->getSubArrayKey($this->creator($item_id, $type))] = ['id' => $item_id,
            'type' => $type,
            'count' => $count];
        Yii::$app->session['cart'] = $array;
    }

    /**
     * @param $item_id
     * @param $type
     */
    public function deleteItem($item_id, $type)
    {
        $item = $this->creator($item_id, $type);
        $array = $this->getArray();
        if ($this->checkItem($item)) {
            $key = $this->getSubArrayKey($item);
            unset($array[$key]);
        }
        Yii::$app->session['cart'] = $array;
    }

    /**
     * Remove all items from cart
     */
    public function resetItems()
    {
        Yii::$app->session->set('cart', []);
    }

    /**
     * @return array item_id => count_items_in_cart
     */
    public function getArray()
    {
        return Yii::$app->session['cart'];
    }

    /**
     * @param CartAdd $item
     * @return int|null|string
     */
    public function getSubArrayKey(CartAdd $item)
    {
        foreach ($this->getArray() as $key => $array) {
            if (($array['type'] == $item->getType()) && ($array['id'] == $item->getId())) {
                return $key;
            }
        }
        return null;
    }


    /**
     * @param $item_id integer
     * @param $type
     * @return null|array
     */
    public function getSubArray($item_id, $type)
    {
        foreach ($this->getArray() as $array) {
            if (($array['type'] == $type) && ($array['id'] == $item_id)) {
                return $array;
            }
        }
        return null;
    }

    /**
     * @return CartElement[]
     */
    public function getModels()
    {
        if (!$this->isEmpty()) {
            $models = [];
            foreach ($this->getArray() as $key => $array) {
                $element = new CartElement();
                $element->model = $this->creator($array['id'], $array['type']);
                $element->count = $array['count'];
                $models[] = $element;
            }
            return $models;
        } else {
            return [];
        }
    }

    /**
     * @param $id integer
     * @param $type
     * @return CartAdd
     */
    public function creator($id, $type)
    {
        if ($type == Item::CART_TYPE) {
            return Item::findOne($id);
        } elseif ($type == Kit::CART_TYPE) {
            return Kit::findOne($id);
        }
    }

    /**
     * @return float cost items in cart
     */
    public function getSum()
    {
        $sum = 0.0;
        $models = $this->getModels();
        foreach ($models as $model) {
            /* @var $model CartElement*/
            $sum += ($model->model->getNewPrice()*$model->count);
        }
        return $sum;
    }

    /**
     * @param $item_id integer
     * @param $type
     * @return int
     */
    public function getSumForItem($item_id, $type)
    {
        $cart = $this->getArray();
        foreach ($cart as $array) {
            if (($array['type'] == $type) && ($array['id'] == $item_id)) {
                $model = $this->creator($item_id, $type);
                return ['newPrice' => $array['count'] * $model->getNewPrice(),
                    'oldPrice' => $model instanceof Kit ? $array['count'] * $model->getOldCost() : $array['count'] * $model->getCost()
                ];
            }
        }
        return ['newPrice' => 0, 'oldPrice' => 0];
    }

    /**
     * @param $item_id integer
     * @param $type
     * @return int
     */
    public function getCountForItem($item_id, $type)
    {
        $cart = $this->getArray();
        foreach ($cart as $array) {
            if (($array['type'] == $type) && ($array['id'] == $item_id)) {
                return $array['count'];
            }
        }
        return 0;
    }

    /**
     * @param $order_id int
     */
    public function saveOrder($order_id)
    {
        $items = $this->getArray();
        if (!empty($items)) {
            foreach ($items as $array) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order_id;
                $orderItem->item_id = $array['id'];
                $orderItem->count = $array['count'];
                $orderItem->type = $array['type'];
                if ($array['type'] == Item::CART_TYPE) {
                    $orderItem->sum = Item::findOne($array['id'])->getNewPrice() * $array['count'];
                } elseif ($array['type'] == Kit::CART_TYPE) {
                    $orderItem->sum = Kit::findOne($array['id'])->getNewPrice() * $array['count'];
                }
                $orderItem->save();
            }
        }
    }

    /**
     * @param CartAdd $item
     * @return bool
     */
    public function checkItem(CartAdd $item)
    {
        foreach ($this->getArray() as $array) {
            if (($array['type'] == $item->getType()) && ($array['id'] == $item->getId())) {
                return true;
            }
        }
        return false;
    }

    public function checkItemInCart($item_id)
    {
        foreach ($this->getArray() as $array) {
            if (($array['type'] == 1) && ($array['id'] == $item_id)) {
                return true;
            }
        }
        return false;
    }

    public function isEmpty()
    {
        if ($this->getCount() == 0) {
            return true;
        } else {
            return false;
        }
    }

}