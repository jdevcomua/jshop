<?php

use yii\db\Migration;

/**
 * Class m190613_090159_add_slug_to_item_cat_table
 */
class m190613_090159_add_slug_to_item_cat_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addColumn('item_cat', 'slug', $this->string()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropColumn('item_cat', 'slug');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190613_090159_add_slug_to_item_cat_table cannot be reverted.\n";

        return false;
    }
    */
}
