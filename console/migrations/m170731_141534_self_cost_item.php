<?php

use yii\db\Migration;

class m170731_141534_self_cost_item extends Migration
{

    public function safeUp()
    {
        $this->addColumn('{{%item}}', 'self_cost', $this->float());
        $this->addColumn('{{%item}}', 'link', $this->string());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%item}}', 'self_cost');
        $this->dropColumn('{{%item}}', 'link');
    }

}
