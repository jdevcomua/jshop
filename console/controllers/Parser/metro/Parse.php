<?php

namespace console\controllers\Parser\metro;

use common\models\ItemCat;
use common\models\Item;
use common\models\Log;
use Exception;
use phpQuery;
use SplFileInfo;
use yii\helpers\Json;
/*
[
    'available' => true,
    'proxy_title' => null,
    'retailer_attributes' => [
        'bundle' => '1'
    ],
    'proxy_number' => null,
    'name' => 'Напиток Бон Буассон Байкал сильногазированный 0,5л',
    'weight' => 500,
    'ean' => '04820203710072',
    'd_unit' => null,
    'price' => 920,
    'extended_info' => [
        'volume' => '500мл',
        'tm' => 'БОН БУАССОН',
        'method' => 'газированная',
    ],
    'sale' => false,
    'bundle' => null,
    'volume' => 500,
    'main_image' => [
        's200x200' => 'https://img3.zakaz.ua/mega.1565179643.ad72436478c_2019-08-09_MarinaR/mega.1565179643.SNCPSG10.obj.0.1.jpg.oe.jpg.pf.jpg.200nowm.jpg.200x.jpg',
        's150x150' => 'https://img3.zakaz.ua/mega.1565179643.ad72436478c_2019-08-09_MarinaR/mega.1565179643.SNCPSG10.obj.0.1.jpg.oe.jpg.pf.jpg.150nowm.jpg.150x.jpg',
        's350x350' => 'https://img3.zakaz.ua/mega.1565179643.ad72436478c_2019-08-09_MarinaR/mega.1565179643.SNCPSG10.obj.0.1.jpg.oe.jpg.pf.jpg.350nowm.jpg.350x.jpg',
        's1350x1350' => 'https://img3.zakaz.ua/mega.1565179643.ad72436478c_2019-08-09_MarinaR/mega.1565179643.SNCPSG10.obj.0.1.jpg.oe.jpg.pf.jpg.1350nowm.jpg.1350x.jpg',
    ],
    'tier_prices' => [],
    'sku' => '411961',
    'path' => [
        0 => 'drinks'
    ],
    'group_id' => [
        0 => 'google-product-feed-413',
        1 => 'drinks-stolichnyi',
        2 => 'soft-drinks-furshet',
        3 => 'carbonated-soft-drinks-furshet',
        4 => 'no-ingredient-carbohydrates-all',
        5 => 'drinks-novus',
        6 => 'carbonated-soft-drinks-megamarket',
        7 => 'soft-drinks-novus',
        8 => 'drinks-megamarket',
        9 => 'no-ingredient-protein',
        10 => 'no-ingredient-fat',
        11 => 'beverages',
        12 => 'no-ingredient-energy-all',
        13 => 'drinks',
        14 => 'no-ingredient-energy',
        15 => 'soft-drinks-auchan',
        16 => 'drinks-1',
        17 => 'soft-drinks-fozzy',
        18 => 'soft-drinks',
        19 => 'no-trange-food-and-drink',
        20 => 'no-ingredient-carbohydrates',
        21 => 'zone-2-auchan',
        22 => 'drinks-auchan',
        23 => 'water-drinks-juices',
        24 => 'soft-drinks-megamarket',
        25 => 'drinks-fozzy',
        26 => 'no-ingredient-fat-all',
        27 => 'no-ingredient-protein-all',
        28 => 'zone-2',
    ],
    'slug' => 'напиток-бон_буассон-500мл',
    'unit' => 'item',
    'weight_netto' => 500,
];
*/
abstract class Parse
{
    protected abstract function process(array $itemArray, int $categoryId, Item $item = null);

    public function parseData()
    {
        try{
            $categories = ItemCat::find()->all();
            $count = $this->getCountOfSlug($categories);
            $countSlag = 0;
            foreach ($categories as $category){
                foreach ($category->parse as $parse){
                    $minusHour = time() - 3600;
                    if((int)$parse->parse_time < $minusHour){
                        echo "\n" . $parse->slug;
                        $countSlag++;
                        if($countSlag % 10 === 0){
                            echo "\n" . $countSlag . ' of ' . $count;
                        }
                        for ($j = 1; $j <= $this->getCountOfPagination(1, $parse->slug); $j++){
                            $items = $this->parseItem($j, $parse->slug);
                            if(!empty($items)){
                                foreach ($items as $itemArray){
                                    $item = Item::find()->where(['barcode' => $itemArray['ean']])->one();
                                    $this->process($itemArray, $category->id, $item);
                                }
                            }
                        }
                        $parse->parse_time = time();
                        $parse->save();
                    }
                }
                Log::write("Parser category {$category->title} Success ({$countSlag} of {$count})");
            }
            return true;
        }catch (Exception $exception){
            $log = new Log();
            $log->message = $exception->getLine() . " " . $exception->getFile() . ": " . $exception->getMessage();
            echo "\n" . $log->message . "\n";
            echo  $exception->getTraceAsString();
            $log->save();
        }
    }

    /**
     * @param $offset integer
     * @param $category string
     * @return bool|mixed|string
     */
    public function parseItem($offset, $category)
    {
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

    public function getCountOfPagination($offset, $category)
    {
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
        return ceil($response[0]['responses'][0]['data']['items'][0]['total']/$response[0]['responses'][0]['data']['items'][0]['limit']);
    }

    public function parseDescription($ean)
    {
        $myCurl = curl_init();
        curl_setopt_array($myCurl, array(
            CURLOPT_URL => 'https://metro.zakaz.ua/api/query.json',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode([
                'meta'=>new \stdClass(),
                'request'=>[
                    [
                        'args'=>[
                            'store_id'=>'48215611',
                            'eans'=>[$ean]
                        ],
                        'v'=>'0.1',
                        'type'=>'product.details',
                        'id'=>'product_'.$ean.'_full',
                    ]
                ]
            ]),
        ));

        $response = curl_exec($myCurl);curl_close($myCurl);
        $response = Json::decode('['.$response.']');
        return $response;
    }

    /**
     * @param $categories ItemCat[]
     * @return int
     */
    protected function getCountOfSlug($categories)
    {

        $count = 0;
        foreach ($categories as $category){
            foreach ($category->parse as $parse){
                $minusHour = time() - 3600;
                if((int)$parse->parse_time < $minusHour){
                    $count++;
                }
            }
        }
        return $count;
    }

    protected function getImageExtension($name)
    {
        $info = new SplFileInfo($name);
        return $info->getExtension();
    }
}