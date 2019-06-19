<?php

use yii\db\Migration;

/**
 * Class m190619_071818_add_columns_to_item_table
 */
class m190619_071818_add_columns_to_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->renameColumn('item', 'addition_date', 'created_at');
        $this->addColumn('item', 'updated_at', $this->timestamp()->null());
        $this->addColumn('item', 'tracker_of_addition', $this->boolean()->null()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->renameColumn('item', 'created_at', 'addition_date');
        $this->dropColumn('item', 'updated_at');
        $this->dropColumn('item', 'tracker_of_addition');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190619_071818_add_columns_to_item_table cannot be reverted.\n";

        return false;
    }
    */
}
