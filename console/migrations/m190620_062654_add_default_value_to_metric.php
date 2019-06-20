<?php

use yii\db\Migration;

/**
 * Class m190620_062654_add_default_value_to_metric
 */
class m190620_062654_add_default_value_to_metric extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->alterColumn('item', 'metric', $this->integer()->defaultValue(1));
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
        echo "m190620_062654_add_default_value_to_metric cannot be reverted.\n";

        return false;
    }
    */
}
