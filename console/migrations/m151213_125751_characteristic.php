<?php

use yii\db\Schema;
use yii\db\Migration;

class m151213_125751_characteristic extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%characteristic}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(),
            'title' => $this->string(50),
        ], $tableOptions);
        $this->addForeignKey("item_cat_characteristic", "{{%characteristic}}", "category_id", "{{%item_cat}}", "id");
        $this->createTable('{{%characteristic_item}}', [
            'id' => $this->primaryKey(),
            'item_id' => $this->integer(),
            'characteristic_id' => $this->integer(),
            'value' => $this->string(50),
        ], $tableOptions);
        $this->addForeignKey("characteristic_item", "{{%characteristic_item}}", "characteristic_id", "{{%characteristic}}", "id", "CASCADE");
        $this->addForeignKey("characteristic", "{{%characteristic_item}}", "item_id", "{{%item}}", "id", "CASCADE");
    }

    public function down()
    {
        $this->dropTable("{{%characteristic}}");
        $this->dropTable("{{%characteristic_item}}");
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
