<?php

namespace frontend\themes\basic;

use yii\web\AssetBundle;
use yii\web\View;

class BasicAsset extends AssetBundle
{
    public $sourcePath  = '@app/themes/basic/assets';
    public $baseUrl     = '@web';
    public $css = [
        'css/rateit.css',
        'css/site.css',
        'css/colorscheme.css',
        'css/color.css',
        'css/wishList.css',
        'css/slider.css',
        'css/owl.carousel.css',
        'css/owl.theme.css',
        'css/font-awesome.min.css',
        'css/jgallery.min.css',
    ];
    public $js = [
        'js/onClickFunctions.js',
        'js/settings.js',
        'js/owl.carousel.min.js',
        'js/jquery.rateit.js',
        'js/cusel-min-2.5.js',
        'js/nouislider.min.js',
        'js/jgallery.js',
        'js/compare.js',
        'js/onReady.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'frontend\assets\AppAsset',
    ];
    public $jsOptions = [
        'position' => View::POS_HEAD,
    ];
    public $cssOptions = [
        'position' => View::POS_HEAD,
    ];
}
