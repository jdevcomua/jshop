<?php

use yii\db\Migration;

class m170804_143559_order_status extends Migration
{
    
    public function safeUp()
    {
        $this->alterColumn('{{%orders}}', 'order_status', $this->integer());
        $this->alterColumn('{{%orders}}', 'payment_status', $this->integer());
    }

    public function safeDown()
    {
        $this->alterColumn('{{%orders}}', 'order_status', $this->string());
        $this->alterColumn('{{%orders}}', 'payment_status', $this->string());
    }

}
