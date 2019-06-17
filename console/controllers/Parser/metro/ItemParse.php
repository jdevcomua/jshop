<?php

namespace console\controllers\Parser\metro;

use common\models\ItemCat;
use common\models\Item;
use Exception;
use phpQuery;
use yii\helpers\Json;

class ItemParse
{

    public function parseData()
    {
        $categories = ItemCat::find()->all();
        foreach ($categories as $category){
            for ($i = 1;$i<100;$i++){
                foreach ($category->slug() as $slug){
                    $items = $this->parseItem($i, $slug);
                    if(!empty($items)){
                        for ($i = 0;$i<count($items);$i++){
                            $item = Item::find()->where(['barcode'=> $items[$i]['ean']])->one();
                            if(!isset($item)){
                                $item = new Item();
                                $item->title = $items[$i]['name'];

                                $item->category_id = $category->id;
                                $item->active = 1;
                                $item->cost = $items[$i]['price']/100;
                                $item->metro_cost = $items[$i]['price']/100;
                                $item->barcode = $items[$i]['ean'];
                                $item->code = $items[$i]['sku'];
                                $item->save();
                            }else{
                                $item->category_id = $category->id;
                                $item->metro_cost = $items[$i]['price']/100;
                                $item->save();
                            }
                        }
                    }
                }
            }
        }
        return false;
    }

    /**
     * @param $offset integer
     * @param $category ItemCat
     * @return bool|mixed|string
     */
    public function parseItem($offset, $category){
        $myCurl = curl_init();
        curl_setopt_array($myCurl, array(
            CURLOPT_URL => 'https://metro.zakaz.ua/api/query.json',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode([
                'meta'=>new \stdClass(),
                'request'=>[
                    [
                        'args'=>['store_id'=>'48215611','slugs'=>[$category],'facets'=>[],'sort'=>'catalog','extended'=>true],
                        'v'=>'0.1',
                        'type'=>'store.products',
                        'id'=>'catalog',
                        'offset'=>$offset,
                        'join'=>[
                            [
                                'apply_as'=>'facets_base',
                                'on'=>['slug','slug'],
                                'request'=>[
                                    'v'=>'0.1',
                                    'type'=>'store.facets',
                                    'args'=>[
                                        'store_id'=>'$request.[-2].args.store_id',
                                        'slug'=>'$request.[-2].args.slugs|first',
                                        'basic_facets'=>[]
                                    ]
                                ]
                            ],
                            [
                                'apply_as'=>'category_tree',
                                'on'=>['slug','requested_slug'],
                                'request'=>[
                                    'v'=>'0.1',
                                    'type'=>'store.department_tree',
                                    'args'=>[
                                        'store_id'=>'$request.[-2].args.store_id',
                                        'slug'=>'$request.[-2].args.slugs|first'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
            ])
        ));

        $response = curl_exec($myCurl);curl_close($myCurl);
        $response = Json::decode('['.$response.']');
        return $response[0]['responses'][0]['data']['items'][0]['items'];
    }

    /**
     * @param $category ItemCat
     */
    public function children($category){
        $children = $category->getChildren();
        if(isset($children)){

        }
    }
}