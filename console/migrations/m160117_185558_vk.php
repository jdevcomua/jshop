<?php

use yii\db\Schema;
use yii\db\Migration;

class m160117_185558_vk extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'vk_id', 'integer');
    }

    public function down()
    {
        echo "m160117_185558_vk cannot be reverted.\n";

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
