<?php

namespace common\models\query;

use common\models\Stock;

/**
 * This is the ActiveQuery class for [[Stock]].
 *
 * @see Stock
 */
class StockQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Stock[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Stock|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return $this
     */
    public function current()
    {
        return $this->andFilterWhere(['<', 'date_from', date('Y-m-d H:i:s')])
            ->andFilterWhere(['>', 'date_to', date('Y-m-d H:i:s')]);
    }

}