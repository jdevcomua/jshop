<?php

namespace www\widgets\LeftTop10;

use common\models\Manufacturer;
use yii\base\Widget;

class LeftTop10 extends Widget
{
    const TOP = 10;

    public $items;

    public function init()
    {
        LeftTop10Assets::register($this->getView());
        parent::init();
    }

    public function run()
    {
        $manufacturersTop10 = null;
        if (count($this->items) > 10){
            $manufacturersTop10 = $this->items;
            usort($manufacturersTop10, function (Manufacturer $item1, Manufacturer $item2){
                return $item2->quantity - $item1->quantity;
            });
            $manufacturersTop10 = array_slice($manufacturersTop10, 0, self::TOP);
        }
        return $this->render('index', [
            'items' => $this->items,
            'top10Items' => $manufacturersTop10
        ]);
    }
}