<?php

use yii\db\Migration;

/**
 * Class m190613_102441_change_title_to_item_cat_table
 */
class m190613_102441_change_title_to_item_cat_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->alterColumn('item_cat', 'title',$this->string(255));
    }

    public function down()
    {
        $this->alterColumn('item_cat', 'title', $this->string(50));
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190613_102441_change_title_to_item_cat_table cannot be reverted.\n";

        return false;
    }
    */
}
