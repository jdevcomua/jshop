<?php

namespace frontend\themes\babyshop;

use yii\web\AssetBundle;
use yii\web\View;

class BabyShopAsset extends AssetBundle
{
    
    public $sourcePath = '@app/themes/babyshop/assets';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/animate.css',
        'css/bootstrap.min.css',
        'css/elements.css',
        'css/timber.scss.css',
        'css/font-awesome.css',
        'css/jquery.fancybox.css',
        'css/owl.carousel.css',
        'css/owl.theme.css',
        'css/owl.transitions.css',
        'css/sca-jquery.fancybox.css',
        'css/sca-quick-view.css',
        'css/style.scss.css',

    ];
    public $js = [
        'js/jquery.jcarousellite.js',
        'js/owl.carousel.min.js',
        'js/bootstrap-custom.js',
        'js/plugins.min.js',
        'js/modernizr.min.js',
        /*'js/onClickFunctions.js',
        'js/settings.js',
        'js/owl.carousel.min.js',
        'js/jquery.rateit.js',
        'js/cusel-min-2.5.js',
        'js/jgallery.js',
        'js/compare.js',*/
        'js/onReady.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
        //'yii\bootstrap\BootstrapPluginAsset',
        'frontend\assets\AppAsset',
    ];
    public $jsOptions = [
        'position' => View::POS_HEAD,
    ];
    public $cssOptions = [
        'position' => View::POS_HEAD,
    ];
    
}
