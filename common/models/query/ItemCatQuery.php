<?php

namespace common\models\query;

use common\models\ItemCat;
use creocoder\nestedsets\NestedSetsQueryBehavior;

/**
 * This is the ActiveQuery class for [[ItemCat]].
 *
 * @see Item
 */
class ItemCatQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return ItemCat[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ItemCat|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function behaviors() {
        return [
            NestedSetsQueryBehavior::className(),
        ];
    }
    
}