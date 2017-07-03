<?php

use yii\web\Application;

class Yii extends \yii\BaseYii
{
    /**@var MyApp*/
    static $app;
}

/**
 * Class MyApp
 *
 * @property \common\components\Cart $cart
 * @property \common\components\UrlHelper $urlHelper
 * @property \common\components\Compare $compare
 * @property \frontend\controllers\Controller $controller
 */
class MyApp extends Application
{

}