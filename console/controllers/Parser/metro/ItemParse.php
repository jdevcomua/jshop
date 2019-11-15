<?php

namespace console\controllers\Parser\metro;

use common\models\Item;
use common\models\Manufacturer;

class ItemParse extends Parse
{

    protected function process(array $itemArray, int $categoryId, Item $item = null)
    {
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
            $item->cost = $itemArray['price']/100;
            $item->metro_cost = $itemArray['price']/100;
            $item->barcode = $itemArray['ean'];
            $item->code = $itemArray['sku'];
        }else{
            $item->category_id = $categoryId;
            $item->self_cost = $itemArray['price']/100;
            $item->cost = $itemArray['price']/100;
            $item->metro_cost = $itemArray['price']/100;
        }

        $manufacturerTitle = $itemArray['extended_info']['tm'];
        $m = Manufacturer::findOne(['name' => $manufacturerTitle]);
        if (empty($m)) {
            $m = new Manufacturer();
            $m->name = $manufacturerTitle;
            $m->save();
            $item->manufacturer_id = $m->id;
        }
        $item->save();
    }
}