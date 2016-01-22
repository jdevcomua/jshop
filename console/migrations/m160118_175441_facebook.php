<?php

use yii\db\Schema;
use yii\db\Migration;

class m160118_175441_facebook extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'fb_id', 'bigint');
    }

    public function down()
    {
        echo "m160118_175441_facebook cannot be reverted.\n";

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
