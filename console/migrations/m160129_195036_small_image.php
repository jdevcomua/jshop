<?php

use yii\db\Schema;
use yii\db\Migration;

class m160129_195036_small_image extends Migration
{
    public function up()
    {
        $this->addColumn('image', 'small', 'varchar(100)');
    }

    public function down()
    {
        echo "m160129_195036_small_image cannot be reverted.\n";

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
