<?php

namespace common\components;

use yii\helpers\Url;
use Yii;

class UrlHelper
{

    public function to($url)
    {
        $newUrl = Yii::$app->language.'/'.current($url);
        $url[0] = $newUrl;
        return Url::to($url);
    }

}