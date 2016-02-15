<?php
/**
 * Created by PhpStorm.
 * User: umka
 * Date: 13.01.16
 * Time: 14:12
 */

namespace common\components;

use common\models\ItemCat;
use common\models\Item;
use yii\base\Component;
use Yii;

class Compare extends Component
{

    public function init()
    {
        parent::init();
        if (empty(Yii::$app->session->get('compare'))) {
            Yii::$app->session->set('compare', []);
        }
    }

    /**
     * @param $item Item
     */
    public function addItem($item)
    {
        $array = Yii::$app->session['compare'];
        $array[$item->id] = $item->category_id;
        Yii::$app->session['compare'] = $array;
    }

    /**
     * @return \yii\db\ActiveRecord[]
     */
    public function getCategories()
    {
        $keys = array_unique(Yii::$app->session['compare']);
        return ItemCat::find()->andFilterWhere(['in', 'id', $keys])->indexBy('id')->all();
    }

    /**
     * @return array
     */
    public function getItems()
    {
        $array = [];
        $categories = array_unique(Yii::$app->session['compare']);
        foreach ($categories as $category_id) {
            $keys = array_keys(Yii::$app->session['compare'], $category_id);
            $items = Item::find()->andFilterWhere(['in', 'id', $keys])->all();
            $array[$category_id] = $items;
        }
        return $array;
    }

    /**
     * @param $item_id integer
     * @return bool
     */
    public function existInList($item_id)
    {
        return array_key_exists($item_id, Yii::$app->session['compare']);
    }

    /**
     * @param integer $id of item
     */
    public function removeItem($id)
    {
        $array = Yii::$app->session['compare'];
        unset($array[$id]);
        Yii::$app->session['compare'] = $array;
    }

    public function resetItems()
    {
        Yii::$app->session->remove('compare');
    }

    public function isEmpty()
    {
        return empty(Yii::$app->session['compare']);
    }

}