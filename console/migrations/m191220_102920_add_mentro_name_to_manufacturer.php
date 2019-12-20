<?php

use yii\db\Migration;

/**
 * Class m191220_102920_add_mentro_name_to_manufacturer
 */
class m191220_102920_add_mentro_name_to_manufacturer extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('manufacturer', 'metro_name', $this->string()->null());
        $this->execute('UPDATE manufacturer SET metro_name = name');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('manufacturer', 'metro_name');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191220_102920_add_mentro_name_to_manufacturer cannot be reverted.\n";

        return false;
    }
    */
}
