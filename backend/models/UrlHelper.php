<?php

namespace backend\models;

use yii\helpers\Url;
use Yii;

class UrlHelper extends Url
{

    public static function to($url){
        $newUrl = Yii::$app->language."/".current($url);
        $url[0] = $newUrl;
        return parent::to($url);
    }

}