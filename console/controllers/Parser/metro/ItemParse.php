<?php

namespace console\controllers\Parser\metro;

use common\models\Item;
use common\models\Log;
use common\models\Manufacturer;

class ItemParse extends Parse
{

    protected function process(array $itemArray, int $categoryId, Item $item = null)
    {
        $manufacturer = null;
        if (isset($itemArray['extended_info']['tm'])){
            $manufacturerTitle = $itemArray['extended_info']['tm'];
            $manufacturer = Manufacturer::findOne(['name' => $manufacturerTitle]);
            if (empty($manufacturer)) {
                $manufacturer = new Manufacturer();
                $manufacturer->name = $manufacturerTitle;
                $manufacturer->save();
            }
        }

        if(!isset($item)){
            $item = new Item();
            $item->title = $itemArray['name'];
            $fullInfo = $this->parseDescription($itemArray['ean']);
            if(isset($fullInfo[0]['responses'][0]['data']['items'][0]['legend'][0])){
                $item->description = $fullInfo[0]['responses'][0]['data']['items'][0]['legend'][0];
            }
            $item->category_id = $categoryId;
            $item->tracker_of_addition = Item::ADDITION_BY_PARSER;
            $item->active = 1;
            $item->self_cost = $itemArray['price']/100;
            $item->cost = round((1 + \Yii::$app->params['metro_percent'] / 100) * $itemArray['price']/100, 2);
            $item->barcode = $itemArray['ean'];
            $item->code = $itemArray['sku'];
            Log::write("Add new https://sdelivery.dn.ua/item/{$item->id} {$item->title}");
        }else{
            $item->category_id = $categoryId;
            if ($item->self_cost != $itemArray['price']/100){
                $newPrice = $itemArray['price']/100;
                Log::write("{$item->id} {$item->title} цена изменена с {$item->self_cost} на {$newPrice}");
                $item->self_cost = $newPrice;
                $item->cost = round((1 + \Yii::$app->params['metro_percent'] / 100) * $itemArray['price']/100, 2);
            }
        }
        if($manufacturer){
            $item->manufacturer_id = $manufacturer->id;
        }

        $item->save();
    }
}