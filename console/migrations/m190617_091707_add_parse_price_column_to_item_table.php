<?php

use yii\db\Migration;

/**
 * Handles adding parse_price to table `{{%item}}`.
 */
class m190617_091707_add_parse_price_column_to_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addColumn('item', 'metro_cost', $this->double()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropColumn('item', 'metro_cost');
    }
}
