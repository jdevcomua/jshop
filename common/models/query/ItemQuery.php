<?php

namespace common\models\query;

use common\models\Item;

/**
 * This is the ActiveQuery class for [[Item]].
 *
 * @see Item
 */
class ItemQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Item[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Item|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return $this
     */
    public function top()
    {
        return $this->joinWith('orderItems')->groupBy('order_item.item_id')
            ->orderBy('count(order_item.count) desc')->limit(3);
    }

    /**
     * @return $this
     */
    public function threeItems()
    {
        return $this->joinWith(['stocks'])->andFilterWhere(['<', 'stock.date_from', date('Y-m-d H:i:s')])
            ->andFilterWhere(['>', 'stock.date_to', date('Y-m-d H:i:s')])->limit(3);
    }
}