<?php

namespace console\controllers\Parser\metro;

use common\models\ItemCat;
use common\models\Item;
use common\models\Log;
use Exception;
use phpQuery;
use SplFileInfo;
use yii\helpers\Json;

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
            $log->message = $exception->getMessage();
            echo "\n".$log->message;
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