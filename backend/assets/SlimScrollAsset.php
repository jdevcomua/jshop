<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class SlimScrollAsset extends AssetBundle
{
    public $sourcePath = '@vendor/grimmlink/jquery-slimscroll';

//    public $baseUrl = '@web';
    public $js = [
        'jquery.slimscroll.min.js',
//        'js/onClickFunctions.js'
    ];
}
