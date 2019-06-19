<?php

use yii\db\Migration;

/**
 * Class m190619_140126_add_metric_column_defaltvalue_to_item_model
 */
class m190619_140126_add_metric_column_defaltvalue_to_item_model extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->alterColumn('item', 'metric', $this->integer()->null()->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {

        $this->alterColumn('item', 'metric', $this->integer()->null());

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190619_140126_add_metric_column_defaltvalue_to_item_model cannot be reverted.\n";

        return false;
    }
    */
}
