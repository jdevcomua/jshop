<?php

use yii\db\Schema;
use yii\db\Migration;

class m160211_145704_order_item_count extends Migration
{
    public function up()
    {
        $this->addColumn('order_item', 'count', 'integer');
    }

    public function down()
    {
        echo "m160211_145704_order_item_count cannot be reverted.\n";

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
