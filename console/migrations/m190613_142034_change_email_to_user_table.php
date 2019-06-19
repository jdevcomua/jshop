<?php

use yii\db\Migration;

/**
 * Class m190613_142034_change_email_to_user_table
 */
class m190613_142034_change_email_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190613_142034_change_email_to_user_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190613_142034_change_email_to_user_table cannot be reverted.\n";

        return false;
    }
    */
}
