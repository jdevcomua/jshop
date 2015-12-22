<?php

namespace frontend\models;

use yii\helpers\Url;
use Yii;

class UrlHelper extends Url
{

    public static function to($url)
    {
        $newUrl = Yii::$app->language . '/' . array_shift($url);
        return parent::to([$newUrl]);
    }

}