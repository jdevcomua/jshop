<?php

use yii\db\Migration;

/**
 * Class m190614_062604_delete_parse_url_and_sluf_from_item_cat_table
 */
class m190614_062604_delete_parse_url_and_sluf_from_item_cat_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->dropColumn('item_cat', 'parse_url');
        $this->dropColumn('item_cat', 'slug');
    }

    public function down()
    {
        $this->addColumn('item_cat', 'slug', $this->string()->null());
        $this->addColumn('item_cat', 'parse_url', $this->string()->null());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190614_062604_delete_parse_url_and_sluf_from_item_cat_table cannot be reverted.\n";

        return false;
    }
    */
}
