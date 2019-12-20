<?php

namespace www\widgets\LeftTop10;

use yii\web\AssetBundle;

class LeftTop10Assets extends AssetBundle
{
    
    public $sourcePath = '@www/widgets/LeftTop10/assets';

    public $js = [
        'js/lefttop10.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    
}
