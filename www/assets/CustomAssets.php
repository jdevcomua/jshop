<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace www\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class CustomAssets extends AssetBundle
{

    public static function version(){
        return str_replace(':','-',str_replace(' ','-',substr(shell_exec("git show HEAD --pretty=format:'%ci'"),0,19)));
    }

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $depends = [
        'www\assets\BabyShopAsset',
    ];

    public function init()
    {
        parent::init();
        $this->js[] = 'js/custom.js?v='.self::version();
        $this->js[] = 'js/shop.js?v='.self::version();
    }
}


