<?php

use yii\db\Schema;
use yii\db\Migration;

class m160114_214146_stock extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('stock', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'date_from' => $this->timestamp(),
            'date_to' => $this->timestamp(),
            'description' => $this->text(),
            'type' => $this->smallInteger(),
            'value' => $this->integer(),
        ], $tableOptions);
        $this->createTable('stock_item', [
            'id' => $this->primaryKey(),
            'item_id' => $this->integer(),
            'stock_id' => $this->integer(),
        ], $tableOptions);
        $this->addForeignKey('stock_item_item', 'stock_item', 'item_id', 'item', 'id');
        $this->addForeignKey('stock_item_stock', 'stock_item', 'stock_id', 'stock', 'id');
    }

    public function down()
    {
        $this->dropTable('stock_item');
        $this->dropTable('stock');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
