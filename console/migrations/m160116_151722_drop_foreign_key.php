<?php

use yii\db\Schema;
use yii\db\Migration;

class m160116_151722_drop_foreign_key extends Migration
{
    public function up()
    {
        $this->dropForeignKey('order_item_ibfk_1', 'order_item');
    }

    public function down()
    {
        echo "m160116_151722_drop_foreign_key cannot be reverted.\n";

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
