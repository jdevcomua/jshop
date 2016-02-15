<?php

use yii\db\Schema;
use yii\db\Migration;

class m160113_102735_item extends Migration
{
    public function up()
    {
        $this->addColumn('item', 'count_of_views', 'integer');
    }

    public function down()
    {
        echo "m160113_102735_item cannot be reverted.\n";

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
