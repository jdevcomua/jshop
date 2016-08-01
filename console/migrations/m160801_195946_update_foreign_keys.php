<?php

use yii\db\Migration;

class m160801_195946_update_foreign_keys extends Migration
{

    public function up()
    {
        $this->dropForeignKey('item_cat_characteristic', "characteristic");
        $this->addForeignKey("item_cat_characteristic", "characteristic", "category_id", "item_cat", "id", 'CASCADE', 'CASCADE');
        $this->dropForeignKey('item_ibfk_1', 'item');
        $this->addForeignKey("item_cat_item", "item", "category_id", "item_cat", "id", 'CASCADE', 'CASCADE');

    }

    public function down()
    {
        $this->dropForeignKey('item_cat_characteristic', "characteristic");
        $this->addForeignKey("item_cat_characteristic", "characteristic", "category_id", "{{%item_cat}}", "id");
        $this->dropForeignKey('item_cat_item', 'item');
        $this->addForeignKey("item_ibfk_1", "item", "category_id", "item_cat", "id", 'SET NULL');

    }

}
