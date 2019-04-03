<?php

use yii\db\Migration;

/**
 * Class m190401_095933_add_column_to_table_item
 */
class m190401_095933_add_column_to_table_item extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('item', 'best_seller', $this->boolean());
        $this->addColumn('item', 'deal_week', $this->boolean());
        $this->addColumn('item', 'special', $this->boolean());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('item', 'best_seller');
        $this->dropColumn('item', 'deal_week');
        $this->dropColumn('item', 'special');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190401_095933_add_column_to_table_item cannot be reverted.\n";

        return false;
    }
    */
}
