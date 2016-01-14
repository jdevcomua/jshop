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
        //var_dump(Yii::$app->compare->isEmpty());die();
        $category = ItemCat::findOne(2);
        /* @var $category ItemCat*/
        $characteristics = $category->getCharacteristics()->indexBy('id')->all();
        //var_dump($characteristics);
        $item = Item::findOne(5);
        /* @var $item Item*/
        $charItems = $item->getCharacteristicItems()->indexBy('characteristic_id')->all();
        //var_dump($charItems);die();
        return $this->render('compare');
    }

    public function actionDelete($item_id)
    {
        Yii::$app->compare->removeItem($item_id);
    }

}