<?php

namespace console\controllers\Parser\karabas;

use console\controllers\Parser\HttpParser;
use Exception;
use phpQuery;

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

        $blocks = $document->find(self::$sel['category']);

        $parse = json_encode($document);
        dg($document);
        $count = 0;
        for ($i = 0; $i < count($blocks); $i++) {
            $block_ru = pq($blocks->elements[$i]);
            $block_li = $block_ru->find(self::$sel['sub_menu']);
            for ($i = 0; $i < count($block_li); $i++) {
                $block_text = pq($block_li->elements[$i]);
                $block_text = $block_text->find(self::$sel['sub_menu_text']);
                $data[$count]['link'] = parse_url($this->link)['scheme'].'://'.parse_url($this->link)['host'] . $block_text->attr('href');;
                $data[$count]['name'] = trim($block_text->text());
                $link = new ItemParse( $data[$count]['link'], self::TIMEOUT);
                $link->downloadContent()->parseData();
                var_dump($data[$count]['name']);
                $count++;
            }
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