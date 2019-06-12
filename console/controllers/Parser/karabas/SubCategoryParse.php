<?php

namespace console\controllers\Parser\karabas;

use console\controllers\Parser\HttpParser;
use Exception;
use phpQuery;
use yii\base\Object;
use yii\helpers\Json;

class SubCategoryParse extends  HttpParser
{

    public static $sel = [
        'category'=>'.filters-category',
        'sub_menu'=>'.level1',
        'sub_menu_text'=>'a',
    ];

    public function parseData()
    {
        if (empty($this->contents['ru'])) {
            return $this;
        }

        $document = $this->contents['ru'];
        $data = [];

        $blocks = $document->find('script[type="text/react-state"]');


        $blocks = str_replace("\n", '',$blocks->text());
        $blocks = str_replace("", '',$blocks);
        $blocks = str_replace('\"', '"',$blocks);
        $blocks = str_replace('\\\'', '\'',$blocks);
        $blocks = str_replace('}{', '},{',$blocks);


        $blocks = Json::decode('['.$blocks.']');
        $myCurl = curl_init();

        curl_setopt_array($myCurl, array(
            CURLOPT_URL => 'https://metro.zakaz.ua/api/query.json',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode([
                'meta'=>new \stdClass(),
                'request'=>[
                    [
                        'args'=>['store_id'=>'48215611','slugs'=>['bread'],'facets'=>[],'sort'=>'catalog','extended'=>true],
                        'v'=>'0.1',
                        'type'=>'store.products',
                        'id'=>'catalog',
                        'offset'=>2,
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
        dg($response);
        for ($i = 0; $i < count($blocks[0]['catalog'][0]['items']); $i++) {
            var_dump($blocks[0]['catalog'][0]['items'][$i]['name']);
        }
        die;
        $this->data = $data;/*Need to change*/
        return $this;
    }



    function download($url, $context = null)
    {
        $content = null;
        $count = 0;

        while (!$content) {
            if ($count > 10) break;
            $count++;
            try {
                $content = file_get_contents($url, null, $context);
                $content = phpQuery::newDocumentHTML($content, 'utf-8');
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        return $content;
    }
}