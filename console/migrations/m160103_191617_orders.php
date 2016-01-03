<?php

use yii\db\Schema;
use yii\db\Migration;

class m160103_191617_orders extends Migration
{
    public function up()
    {
        $this->addColumn('orders', 'order_status', 'varchar(25)');
        $this->addColumn('orders', 'payment_status', 'varchar(25)');
    }

    public function down()
    {
        echo "m160103_191617_orders cannot be reverted.\n";

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
