<?php

use yii\db\Migration;

/**
 * Class m190613_092750_add_cascade_to_item_table
 */
class m190613_092750_add_cascade_to_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->dropForeignKey('item_cat_item', 'item');
        $this->addForeignKey('item_cat_item', 'item', 'category_id','item_cat','id','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropForeignKey('item_cat_item', 'item');
        $this->addForeignKey('item_cat_item', 'item', 'category_id','item_cat','id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190613_092750_add_cascade_to_item_table cannot be reverted.\n";

        return false;
    }
    */
}
