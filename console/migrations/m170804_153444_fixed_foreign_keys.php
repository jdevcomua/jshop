<?php

use yii\db\Migration;

class m170804_153444_fixed_foreign_keys extends Migration
{

    public function safeUp()
    {
        $this->dropForeignKey('{{%order_item_ibfk_2}}', '{{%order_item}}');
        $this->addForeignKey('{{%order_item_ibfk_2}}', '{{%order_item}}', 'order_id', '{{%orders}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
    }

}
