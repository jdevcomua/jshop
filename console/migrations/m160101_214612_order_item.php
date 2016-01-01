<?php

use yii\db\Schema;
use yii\db\Migration;

class m160101_214612_order_item extends Migration
{
    public function up()
    {
        $this->addColumn('orders', 'sum', 'float');
        $this->addColumn('order_item', 'sum', 'float');
    }

    public function down()
    {
        echo "m160101_214612_order_item cannot be reverted.\n";

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
