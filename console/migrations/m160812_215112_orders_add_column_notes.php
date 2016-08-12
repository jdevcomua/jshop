<?php

use yii\db\Migration;

class m160812_215112_orders_add_column_notes extends Migration
{
    public function up()
    {
        $this->addColumn('orders', 'comment', 'text');
    }

    public function down()
    {
        $this->dropColumn('orders', 'comment');
    }

}
