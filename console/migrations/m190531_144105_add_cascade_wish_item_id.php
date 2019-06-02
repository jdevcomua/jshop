<?php

use yii\db\Migration;

/**
 * Class m190531_144105_drop_foreign_key_from_item
 */
class m190531_144105_add_cascade_wish_item_id extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->dropForeignKey('wish_item', 'wish');
        $this->addForeignKey('wish_item', 'wish', 'item_id','item','id','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropForeignKey('wish_item', 'wish');
        $this->addForeignKey('wish_item', 'wish', 'item_id','item','id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190531_144105_drop_foreign_key_from_item cannot be reverted.\n";

        return false;
    }
    */
}
