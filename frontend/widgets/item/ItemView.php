<?php

namespace frontend\widgets\item;

use common\models\Item;
use yii\base\Exception;
use yii\base\Widget;

class ItemView extends Widget
{
    const TYPE_ITEM = 1;
    const TYPE_CART = 2;

    /**@var Item*/
    public $model;

    public $type;

    public function init()
    {
        parent::init();
        $this->type = self::TYPE_ITEM;
    }

    public function run()
    {
        if ($this->type == self::TYPE_ITEM) {
            return $this->render('item', [
                'model' => $this->model,
            ]);
        }elseif($this->type == self::TYPE_CART){
            return $this->render('cart', [
                'model' => $this->model,
            ]);
        }
        throw new Exception('ItemView type not found');
    }
}