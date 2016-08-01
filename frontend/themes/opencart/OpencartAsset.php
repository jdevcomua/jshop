<?php

namespace frontend\themes\opencart;

use yii\web\AssetBundle;
use yii\web\View;

class OpencartAsset extends AssetBundle
{
    public $sourcePath  = '@app/themes/opencart/assets';
    public $baseUrl     = '@web';
    public $css = [
        'bootstrap/css/bootstrap.min.css',
        'font-awesome/css/font-awesome.min.css',
        'css/stylesheet.css',
        'css/flexslider.css',
    ];
    public $js = [
        'bootstrap/js/bootstrap.min.js',
        'js/common.js',
        'js/jquery.flexslider-min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
    public $jsOptions = [
        'position' => View::POS_HEAD,
    ];
    public $cssOptions = [
        'position' => View::POS_HEAD,
    ];
}
