<?php

use yii\db\Migration;

/**
 * Class m190613_092320_add_cascade_to_kit_item_table
 */
class m190613_092320_add_cascade_to_kit_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->dropForeignKey('kit_item_item', 'kit_item');
        $this->addForeignKey('kit_item_item', 'kit_item', 'item_id','item','id','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropForeignKey('kit_item_item', 'kit_item');
        $this->addForeignKey('kit_item_item', 'kit_item', 'item_id','item','id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190613_092320_add_cascade_to_kit_item_table cannot be reverted.\n";

        return false;
    }
    */
}
