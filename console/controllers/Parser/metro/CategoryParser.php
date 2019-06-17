<?php

namespace console\controllers\Parser\metro;

use console\controllers\Parser\HttpParser;
use Exception;
use keltstr\simplehtmldom\SimpleHTMLDom;
use phpQuery;


class CategoryParser extends  HttpParser
{
    const TIMEOUT = 180;
    public static $sel = [
        'menu' => '.main-menu-item',
        'main-menu' => '.main-menu',
        'sub_menu'=>'.menu-submenu',
        'sub_menu_item'=>'.menu-submenu-item',
        'sub_menu_item_a'=>'a',

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
        for ($i = 0; $i < count($blocks); $i++) {
            $block_ru = pq($blocks->elements[$i]);
            $block_li = $block_ru->find(self::$sel['menu']);
            $block_list=$block_ru->find(self::$sel['sub_menu']);

            for ($j = 0; $j < count($block_li); $j++) {
                $block_sub_menu = pq($block_list->elements[$j]);
                $block_sub_menu = $block_sub_menu->find(self::$sel['sub_menu_item']);
                $block_sub_menu = $block_sub_menu->find(self::$sel['sub_menu_item_a']);
                $block_sub_menu_text = pq($block_sub_menu->elements[0]);
                $data_sub_menu[$count]['link'] = parse_url($this->link)['scheme'].'://'.parse_url($this->link)['host'] . $block_sub_menu_text->attr('href');
                $link = new SubCategoryParse($data_sub_menu[$count]['link'], self::TIMEOUT);
                $link->downloadContent()->parseData();
                $count++;


            }
        }

        return null;
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
}