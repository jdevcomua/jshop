<?php

use yii\db\Schema;
use yii\db\Migration;

class m160211_145704_order_item_count extends Migration
{
    
    public function up()
    {
        $this->addColumn('{{%order_item}}', 'count', 'integer');
    }

    public function down()
    {
        $this->dropColumn('{{%order_item}}', 'count');
    }

}
