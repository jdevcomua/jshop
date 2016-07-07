<?php

use yii\db\Migration;

class m160707_071317_foreign_keys extends Migration
{

    public function up()
    {
        $this->dropForeignKey('stock_item_stock', 'stock_item');
        $this->addForeignKey('stock_item_stock', 'stock_item', 'stock_id', 'stock', 'id', 'CASCADE', 'CASCADE');
        $this->dropForeignKey('kit_item_kit', 'kit_item');
        $this->addForeignKey('kit_item_kit', 'kit_item', 'kit_id', 'kit', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('stock_item_stock', 'stock_item');
        $this->addForeignKey('stock_item_stock', 'stock_item', 'stock_id', 'stock', 'id');
        $this->dropForeignKey('kit_item_kit', 'kit_item');
        $this->addForeignKey('kit_item_kit', 'kit_item', 'kit_id', 'kit', 'id');
    }

}
