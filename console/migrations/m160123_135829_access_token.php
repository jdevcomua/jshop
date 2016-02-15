<?php

use yii\db\Schema;
use yii\db\Migration;

class m160123_135829_access_token extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'access_token', 'varchar(50) unique');
    }

    public function down()
    {
        echo "m160123_135829_access_token cannot be reverted.\n";

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
