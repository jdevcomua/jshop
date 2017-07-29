<?php

use yii\db\Migration;

class m170729_160407_category_active extends Migration
{

    public function safeUp()
    {
        $this->addColumn('{{%item_cat}}', 'active', $this->boolean());
        $this->addColumn('{{%item}}', 'active', $this->boolean());
        $this->addColumn('{{%item}}', 'top', $this->boolean());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%item_cat}}', 'active');
        $this->dropColumn('{{%item}}', 'active');
        $this->dropColumn('{{%item}}', 'top');
    }

}
