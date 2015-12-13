<?php

namespace common\models\search;

/**
 * This is the ActiveQuery class for [[\app\models\Item]].
 *
 * @see \app\models\Item
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
     * @return \common\models\Item[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\Item|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}