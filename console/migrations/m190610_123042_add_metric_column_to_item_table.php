<?php

use yii\db\Migration;

/**
 * Handles adding metric to table `{{%item}}`.
 */
class m190610_123042_add_metric_column_to_item_table extends Migration
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
}
