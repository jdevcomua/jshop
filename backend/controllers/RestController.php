<?php
/**
 * Created by PhpStorm.
 * User: umka
 * Date: 19.01.16
 * Time: 0:06
 */

namespace backend\controllers;

use yii\rest\ActiveController;

class RestController extends ActiveController
{

    public $modelClass = 'common\models\Item';

}