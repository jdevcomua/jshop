<?php

use yii\db\Migration;

/**
 * Class m190619_133332_add_metric_column_to_item_model
 */
class m190619_133332_add_metric_column_to_item_model extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addColumn('item', 'metric', $this->integer()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {

        $this->dropColumn('item', 'metric');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190619_133332_add_metric_column_to_item_model cannot be reverted.\n";

        return false;
    }
    */
}
