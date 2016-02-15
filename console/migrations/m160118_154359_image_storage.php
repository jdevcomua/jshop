<?php

use yii\db\Schema;
use yii\db\Migration;

class m160118_154359_image_storage extends Migration
{
    public function up()
    {
        $this->addColumn('item', 'image_storage', 'varchar(25)');
        $this->update('item', ['image_storage' => \common\models\Item::MY_SERVER]);
    }

    public function down()
    {
        echo "m160118_154359_image_storage cannot be reverted.\n";

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
