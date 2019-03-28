<?php

namespace www\widgets\sliders\flex;

use yii\web\AssetBundle;

/**
 * Assets of FlexSlider.
 */
class FlexSliderAsset extends AssetBundle
{

    public $css = [
        'flexslider.css',
    ];

    public $js = [
        'jquery.flexslider-min.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    public function init()
    {
        parent::init();
        $this->sourcePath = __DIR__ . '/assets';
    }

}
