<?php

use yii\db\Schema;
use yii\db\Migration;

class m160128_221829_item_description extends Migration
{
    public function up()
    {
        $this->addColumn('item', 'description', 'text');
    }

    public function down()
    {
        echo "m160128_221829_item_description cannot be reverted.\n";

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
