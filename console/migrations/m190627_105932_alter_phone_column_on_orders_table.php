<?php

use yii\db\Migration;

/**
 * Class m190627_105932_alter_phone_column_on_orders_table
 */
class m190627_105932_alter_phone_column_on_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->alterColumn('orders', 'phone', $this->string(25));
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {

        $this->alterColumn('orders', 'phone', $this->string(15));

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190627_105932_alter_phone_column_on_orders_table cannot be reverted.\n";

        return false;
    }
    */
}
