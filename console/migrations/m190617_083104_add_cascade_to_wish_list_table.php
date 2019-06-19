<?php

use yii\db\Migration;

/**
 * Class m190617_083104_add_cascade_to_wish_list_table
 */
class m190617_083104_add_cascade_to_wish_list_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->dropForeignKey('wish_list_user', 'wish_list');
        $this->addForeignKey('wish_list_user', 'wish_list', 'user_id','user','id','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropForeignKey('wish_list_user', 'wish_list');
        $this->addForeignKey('wish_list_user', 'wish_list', 'user_id','user','id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190617_083104_add_cascade_to_wish_list_table cannot be reverted.\n";

        return false;
    }
    */
}
