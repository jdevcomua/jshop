<?php

namespace common\models\search;

/**
 * This is the ActiveQuery class for [[\app\models\Vote]].
 *
 * @see \app\models\Vote
 */
class VoteQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\common\models\Vote[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\common\models\Vote|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}