<?php

use yii\db\Migration;

/**
 * Class m190614_062858_add_parse_table
 */
class m190614_062858_add_parse_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('parse', [
            'id' => $this->primaryKey(),
            'url' => $this->string(),
            'slug' => $this->string(),
            'category_id'=>$this->integer(),
        ]);
        $this->addForeignKey(
            'item_cat_id',
            'parse',
            'category_id',
            'item_cat',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey(
            'item_cat_item',
            'parse'
        );
        $this->dropTable('parse');
    }
    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190614_062858_add_parse_table cannot be reverted.\n";

        return false;
    }
    */
}
