<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;


class SlimScrollAsset extends AssetBundle
{
    public $sourcePath = '@vendor/grimmlink/jquery-slimscroll';

    public $js = [
        'jquery.slimscroll.min.js',
    ];
}
