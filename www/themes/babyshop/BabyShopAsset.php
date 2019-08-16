<?php

namespace www\themes\babyshop;

use yii\web\AssetBundle;
use yii\web\View;

class BabyShopAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'stylesheet/bootstrap.min.css',
        'stylesheet/font-awesome.css',
        'stylesheet/revslider.css',
        'stylesheet/owl.carousel.css',
        'stylesheet/owl.theme.css',
        'stylesheet/jquery.bxslider.css',
        'stylesheet/jquery.mobile-menu.css',
        'stylesheet/style.css',
        'stylesheet/responsive.css',
        'stylesheet/socials/jssocials.css',
        'stylesheet/socials/jssocials-theme-classic.css',
        'stylesheet/socials/jssocials-theme-flat.css',
        'stylesheet/socials/jssocials-theme-minima.css',
        'stylesheet/socials/jssocials-theme-plain.css',
    ];
    public $js = [
        'js/bootstrap.min.js',
        'js/parallax.js',
        'js/revslider.js',
        'js/common.js',
        'js/jquery.bxslider.min.js',
        'js/owl.carousel.min.js',
        'js/jquery.mobile-menu.min.js',
        'js/countdown.js',
        'js/socials/jssocials.js',
        'js/socials/jssocials.min.js',
    ];
    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
//        'yii\bootstrap\BootstrapPluginAsset',
        'www\assets\AppAsset',
        'yii\widgets\PjaxAsset'
    ];
    
}
