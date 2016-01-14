<?php
/**
 * Created by PhpStorm.
 * User: umka
 * Date: 13.01.16
 * Time: 13:58
 */

namespace frontend\controllers;

use common\models\Item;
use common\models\ItemCat;
use Yii;

class CompareController extends Controller
{

    public function actionCompare()
    {
        return $this->render('compare');
    }

    public function actionDelete($item_id)
    {
        Yii::$app->compare->removeItem($item_id);
    }

}