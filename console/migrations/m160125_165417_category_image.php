<?php

use yii\db\Schema;
use yii\db\Migration;

class m160125_165417_category_image extends Migration
{
    public function up()
    {
        $this->addColumn('item_cat', 'image', 'varchar(100)');
    }

    public function down()
    {
        echo "m160125_165417_category_image cannot be reverted.\n";

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
