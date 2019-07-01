<?php

use yii\db\Migration;

/**
 * Class m190621_083748_change_mail_to_email_on_orders_table
 */
class m190621_083748_change_mail_to_email_on_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->renameColumn('orders','mail','email');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->renameColumn('orders','email','mail');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190621_083748_change_mail_to_email_on_orders_table cannot be reverted.\n";

        return false;
    }
    */
}
