<?php

namespace common\components;

use yii\helpers\Url;
use Yii;

class UrlHelper
{

    public function to($url)
    {
        $url['language'] = Yii::$app->language;
        return Url::to($url);
    }

}