<?php

use yii\db\Schema;
use yii\db\Migration;

class m160126_222651_stock_image extends Migration
{
    public function up()
    {
        $this->addColumn('stock', 'image', 'varchar(100)');
    }

    public function down()
    {
        echo "m160126_222651_stock_image cannot be reverted.\n";

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
