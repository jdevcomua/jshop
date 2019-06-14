<?php

namespace console\controllers\Parser\karabas;

use common\models\ItemCat;
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
        $blocks = str_replace('', '',$blocks);
        $blocks = str_replace('', '',$blocks);
        $blocks = str_replace('\\\'', '\'',$blocks);
        $blocks = str_replace('}{', '},{',$blocks);
        $blocks = Json::decode('['.$blocks.']');
        $itemCat = new ItemCat();
        $itemCat->title = $blocks[0]['catalog'][0]['category_tree']['name'];
        $itemCat->slug =$blocks[0]['catalog'][0]['category_tree']['slug'];
        $category = ItemCat::find()->where(['slug'=>$blocks[0]['catalog'][0]['category_tree']['slug']])->exists();
        if(!$category){
            $itemCat->save();
        }
        $this->children($blocks[0]['catalog'][0]['category_tree']);

        return true;
    }

    public function children($block){

        if(isset($block['children'])){

            $parent = ItemCat::find()->where(['title'=>$block['name']])->one();
            for ($i = 0; $i < count($block['children']); $i++) {
                $subItemCat = new ItemCat();
                $subItemCat->title =$block['children'][$i]['name'];
                $subItemCat->parse_url = parse_url($this->link)['scheme'].'://'.parse_url($this->link)['host'].$block['children'][$i]['link'];
                $subItemCat->slug = $block['children'][$i]['slug'];
                $subItemCat->parent_id = $parent->id;
                $category = ItemCat::find()->where(['slug'=>$block['children'][$i]['slug']])->exists();
                if(!$category){
                    $subItemCat->save();
                }
                $this->children($block['children'][$i]);
        }
        }
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