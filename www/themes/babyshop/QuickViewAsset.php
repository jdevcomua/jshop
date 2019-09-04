<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace www\themes\babyshop;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class QuickViewAsset extends AssetBundle
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
    ];
    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
//        'yii\bootstrap\BootstrapPluginAsset',
        'www\assets\AppAsset',
        'yii\widgets\PjaxAsset'
    ];
}
