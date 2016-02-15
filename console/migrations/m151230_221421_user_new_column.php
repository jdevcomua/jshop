<?php

use yii\db\Schema;
use yii\db\Migration;

class m151230_221421_user_new_column extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'phone', 'varchar(25)');
        $this->addColumn('user', 'password', 'varchar(25)');
        $this->addColumn('user', 'username', 'varchar(25)');
        $this->addColumn('user', 'surname', 'varchar(25)');
        $this->addColumn('user', 'address', 'varchar(100)');
    }

    public function down()
    {
        echo "m151230_221421_user_new_column cannot be reverted.\n";

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
