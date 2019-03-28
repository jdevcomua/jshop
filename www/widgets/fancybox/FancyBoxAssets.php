<?php

namespace www\widgets\fancybox;

use yii\web\AssetBundle;

class FancyBoxAssets extends AssetBundle
{
    
    public $sourcePath = '@www/widgets/fancybox/assets';

    public $css = [
        'css/jquery.fancybox.min.css',
    ];
    public $js = [
        'js/jquery.fancybox.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    
}
