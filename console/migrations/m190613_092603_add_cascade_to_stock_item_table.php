<?php

use yii\db\Migration;

/**
 * Class m190613_092603_add_cascade_to_stock_item_table
 */
class m190613_092603_add_cascade_to_stock_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->dropForeignKey('stock_item_item', 'stock_item');
        $this->addForeignKey('stock_item_item', 'stock_item', 'item_id','item','id','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropForeignKey('stock_item_item', 'stock_item');
        $this->addForeignKey('stock_item_item', 'stock_item', 'item_id','item','id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190613_092603_add_cascade_to_stock_item_table cannot be reverted.\n";

        return false;
    }
    */
}
