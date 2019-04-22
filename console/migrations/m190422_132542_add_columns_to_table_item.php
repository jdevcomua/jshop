<?php

use yii\db\Migration;

/**
 * Class m190422_132542_add_columns_to_table_item
 */
class m190422_132542_add_columns_to_table_item extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('item', 'barcode', $this->char(20));
        $this->addColumn('item', 'code', $this->char(20));
        $this->addColumn('item', 'quantity', $this->decimal(2));

        $this->createIndex(
            'idx-item-barcode',
            'item',
            'barcode'
        );
        $this->createIndex(
            'idx-item-code',
            'item',
            'code'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-item-barcode','item');
        $this->dropIndex('idx-item-code','item');

        $this->dropColumn('item', 'barcode');
        $this->dropColumn('item', 'code');
        $this->dropColumn('item', 'quantity');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190422_132542_add_columns_to_table_item cannot be reverted.\n";

        return false;
    }
    */
}
