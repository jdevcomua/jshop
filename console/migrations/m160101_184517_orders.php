<?php

use yii\db\Schema;
use yii\db\Migration;

class m160101_184517_orders extends Migration
{
    public function up()
    {
        $this->addColumn('orders', 'address', 'varchar(50)');
        $this->addColumn('orders', 'name', 'varchar(50)');
        $this->addColumn('orders', 'phone', 'varchar(15)');
        $this->addColumn('orders', 'delivery', 'varchar(50)');
        $this->addColumn('orders', 'mail', 'varchar(50)');
        $this->addColumn('orders', 'payment', 'varchar(50)');
    }

    public function down()
    {
        echo "m160101_184517_orders cannot be reverted.\n";

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
