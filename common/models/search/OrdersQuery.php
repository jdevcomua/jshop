<?php

namespace common\models\search;

/**
 * This is the ActiveQuery class for [[\app\models\Orders]].
 *
 * @see \app\models\Orders
 */
class OrdersQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\Orders[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\Orders|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}