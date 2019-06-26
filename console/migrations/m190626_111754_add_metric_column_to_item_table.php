<?php

use yii\db\Migration;

/**
 * Handles adding metric to table `{{%item}}`.
 */
class m190626_111754_add_metric_column_to_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addColumn('item', 'metric', $this->integer()->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropColumn('item', 'metric');
    }
}
