<?php

use yii\db\Schema;
use yii\db\Migration;

class m160122_005521_categories extends Migration
{
    public function up()
    {
        $this->addColumn('item_cat', 'parent_id', 'integer');
        $this->addColumn('item_cat', 'level', 'integer');
        $this->addForeignKey('category_parent', 'item_cat', 'parent_id', 'item_cat', 'id', 'SET NULL');
        $this->update('item_cat', ['level' => 1]);
    }

    public function down()
    {
        echo "m160122_005521_categories cannot be reverted.\n";

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
