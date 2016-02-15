<?php

use yii\db\Schema;
use yii\db\Migration;

class m160108_114511_wishlist extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('wish_list', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'user_id' => $this->integer(),
        ], $tableOptions);
        $this->addForeignKey('wish_list_user', 'wish_list', 'user_id', 'user', 'id');
        $this->createTable('wish', [
            'id' => $this->primaryKey(),
            'list_id' => $this->integer(),
            'item_id' => $this->integer(),
        ], $tableOptions);
        $this->addForeignKey('wish_list', 'wish', 'list_id', 'wish_list', 'id');
        $this->addForeignKey('wish_item', 'wish', 'item_id', 'item', 'id');
    }

    public function down()
    {
        $this->dropTable('wish');
        $this->dropTable('wish_list');

        return false;
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
