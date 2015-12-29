<?php

namespace common\components;

use yii\base\Component;
use common\models\Item;
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
        Yii::$app->session->open();
        if (empty(Yii::$app->session->get('cart'))) {
            Yii::$app->session->set('cart', []);
        }
    }

    public function getCount()
    {
        $sum = 0;
        foreach (Yii::$app->session['cart'] as $item) {
            $sum += $item;
        }
        return $sum;
    }

    public function addItem($item_id, $count = 1)
    {
        $array = Yii::$app->session['cart'];
        if (isset($array[$item_id])) {
            $array[$item_id] += $count;
        } else {
            $array[$item_id] = 1;
        }
        Yii::$app->session['cart'] = $array;
    }

    public function deleteItem($item_id, $count = 0)
    {
        $array = Yii::$app->session['cart'];
        if ($count > 0){
            $array[$item_id] -= $count;
        } else {
            unset($array[$item_id]);
        }
        Yii::$app->session['cart'] = $array;
    }

    public function resetItems()
    {
        Yii::$app->session->remove('cart');
    }

    public function getItems()
    {
        return Yii::$app->session['cart'];
    }

    public function getItemsModels()
    {
        return Item::find()->andFilterWhere(['in', 'id', array_keys(Yii::$app->session['cart'])])->all();
    }

    public function getSum()
    {
        $sum = 0;
        $itemsCount = $this->getItems();
        $items = $this->getItemsModels();
        foreach ($items as $item) {
            /* @var $item Item*/
            $sum += ($item->cost*$itemsCount[$item->id]);
        }
        return $sum;
    }

}