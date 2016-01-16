<?php

use yii\db\Schema;
use yii\db\Migration;

class m160116_092207_kit extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('kit', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'description' => $this->text(),
            'cost' => $this->float()
        ], $tableOptions);
        $this->createTable('kit_item', [
            'id' => $this->primaryKey(),
            'item_id' => $this->integer(),
            'kit_id' => $this->integer()
        ], $tableOptions);
        $this->addForeignKey('kit_item_kit', 'kit_item', 'kit_id', 'kit', 'id');
        $this->addForeignKey('kit_item_item', 'kit_item', 'item_id', 'item', 'id');
        $this->addColumn('order_item', 'type', 'smallint');
    }

    public function down()
    {
        $this->dropTable('kit');
        $this->dropTable('kit_item');
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
