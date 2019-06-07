<?php

namespace console\controllers\Parser\karabas;

use console\controllers\Parser\HttpParser;
use Exception;
use keltstr\simplehtmldom\SimpleHTMLDom;
use phpQuery;


class CityParser extends  HttpParser
{
    public static $sel = [
        'menu' => '.main-menu-item',
        'main-menu' => '.main-menu',
        'text' => ' .main-menu-item-text',
        'sub_menu'=>'.menu-submenu',
        'sub_menu_item'=>'.menu-submenu-item',
        'sub_menu_item_a'=>'a',
        'sub_menu_item_text'=>'u',

    ];

    public function parseData()
    {
        if (empty($this->contents['ru'])) {
            return $this;
        }

        $document = $this->contents['ru'];
        $data = [];
        $data_sub_menu = [];

        $blocks = $document->find(self::$sel['main-menu']);
        $count = 0;
        $count_sub_menu = 0;
        for ($i = 0; $i < count($blocks); $i++) {
            $block_ru = pq($blocks->elements[$i]);
            $block_li = $block_ru->find(self::$sel['menu']);
            $block_list=$block_ru->find(self::$sel['sub_menu']);
            for ($j = 0; $j < count($block_li); $j++) {
                $block_name = pq($block_li->elements[$j]);
                $block_name = $block_name->find(self::$sel['text']);
                $data[$count]['name'] = trim($block_name->text());
                var_dump($data[$count]['name']);
                $block_sub_menu = pq($block_list->elements[$j]);
                $block_sub_menu = $block_sub_menu->find(self::$sel['sub_menu_item']);
                $block_sub_menu = $block_sub_menu->find(self::$sel['sub_menu_item_a']);
                for ($u = 0; $u < count($block_sub_menu); $u++) {
                    $block_sub_menu_text = pq($block_sub_menu->elements[$u]);
                    $data_sub_menu[$count_sub_menu]['link'] = parse_url($this->link)['scheme'].'://'.parse_url($this->link)['host'] . $block_sub_menu_text->attr('href');;
                    $block_sub_menu_text = $block_sub_menu_text->find(self::$sel['sub_menu_item_text']);
                    $data_sub_menu[$count_sub_menu]['name'] = trim($block_sub_menu_text->text());
                    var_dump($data_sub_menu[$count_sub_menu]['name']);
                    var_dump($data_sub_menu[$count_sub_menu]['link']);
                    $count_sub_menu++;
                }
                $count++;
            }
        }

        $this->data = $data;
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
                $content = phpQuery::newDocumentHTML($content);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        return $content;
    }
//try{
//$request = $this->client->get($url);
//$this->lastResponse = $request->send();
//
//$page = SimpleHTMLDom::str_get_html($this->lastResponse->content);
//foreach($page->find('.main-menu-item') as $maincategory){
//$cat_name = $maincategory->find('.main-menu-item-text');
//$cat_name = reset($cat_name)->plaintext;
//echo $cat_name;
//}
//}catch(Exception $e){
//    echo $e->getMessage() .' '. $e->getCode() .' '. $e->getLine() . ' ' .$e->getFile();
//}
}