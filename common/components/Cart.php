<?php

namespace common\components;

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
        foreach ($this->getItems() as $item) {
            $sum += $item;
        }
        return $sum;
    }

    /**
     * @param $item_id
     * @param int $count items to add
     */
    public function addItem($item_id, $count = 1)
    {
        $array = $this->getItems();
        if (isset($array[$item_id])) {
            $array[$item_id] = $array[$item_id] + $count;
        } else {
            $array[$item_id] = $count;
        }
        Yii::$app->session['cart'] = $array;
    }

    /**
     * Delete item from cart if count is not set and subtract count if it set
     * @param $item_id
     * @param int $count items to delete. If 0 - delete all
     */
    public function deleteItem($item_id, $count = 0)
    {
        $array = $this->getItems();
        if (isset($array[$item_id])) {
            if ($count > 0) {
                $array[$item_id] = $array[$item_id] - $count;
            } else {
                unset($array[$item_id]);
            }
        }
        Yii::$app->session['cart'] = $array;
    }

    /**
     * Remove all items from cart
     */
    public function resetItems()
    {
        Yii::$app->session->remove('cart');
    }

    /**
     * @return array item_id => count_items_in_cart
     */
    public function getItems()
    {
        return Yii::$app->session['cart'];
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getItemsModels()
    {
        $items = $this->getItems();
        if (empty($items)) {
            return [];
        } else {
            return Item::find()->filterWhere(['in', 'id', array_keys($items)])->all();
        }
    }

    /**
     * @return float cost items in cart
     */
    public function getSum()
    {
        $sum = 0.0;
        $itemsCount = $this->getItems();
        $items = $this->getItemsModels();
        foreach ($items as $item) {
            /* @var $item Item*/
            $sum += ($item->getNewPrice()*$itemsCount[$item->id]);
        }
        return $sum;
    }

    /**
     * @param $item_id
     * @return int
     */
    public function getSumForItem($item_id)
    {
        $cart = $this->getItems();
        if (isset($cart[$item_id]) && !empty(Item::findOne($item_id)->getNewPrice())) {
            return $cart[$item_id] * Item::findOne($item_id)->getNewPrice();
        } else {
            return 0;
        }
    }

    /**
     * @param $item_id
     * @return int
     */
    public function getCountForItem($item_id)
    {
        $cart = $this->getItems();
        if (isset($cart[$item_id])){
            return $cart[$item_id];
        } else {
            return 0;
        }
    }

    /**
     * @param $order_id int
     */
    public function saveOrder($order_id)
    {
        $items = $this->getItems();
        if (!empty($items)) {
            foreach ($items as $item_id => $count) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order_id;
                $orderItem->item_id = $item_id;
                $orderItem->count = $count;
                $orderItem->sum = Item::findOne($item_id)->getNewPrice()*$count;
                $orderItem->save();
            }
        }
    }

    /**
     * @param $item_id
     * @return bool
     */
    public function checkItemInCart($item_id)
    {
        return array_key_exists($item_id, $this->getItems());
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