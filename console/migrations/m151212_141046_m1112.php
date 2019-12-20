<?php

use yii\db\Schema;
use yii\db\Migration;

class m151212_141046_m1112 extends Migration
{
    public function up()
    {
        $this->execute(file_get_contents(__DIR__ . "/init.sql"));
    }

    public function down()
    {
        echo "m151212_141046_m1112 cannot be reverted.\n";

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
