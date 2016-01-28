<?php

use yii\db\Schema;
use yii\db\Migration;

class m160126_142206_item_addition_date extends Migration
{
    public function up()
    {
        $this->addColumn('item', 'addition_date', 'timestamp default CURRENT_TIMESTAMP');
    }

    public function down()
    {
        echo "m160126_142206_item_addition_date cannot be reverted.\n";

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
