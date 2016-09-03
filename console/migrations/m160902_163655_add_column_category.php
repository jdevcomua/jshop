<?php

use yii\db\Migration;

class m160902_163655_add_column_category extends Migration
{
    public function up()
    {
        $this->addColumn('item_cat', 'lft', 'integer');
        $this->addColumn('item_cat', 'rgt', 'integer');
        $this->addColumn('item_cat', 'depth', 'integer');
        $this->addColumn('item_cat', 'tree', 'integer');
    }

    public function down()
    {
        $this->dropColumn('item_cat', 'lft');
        $this->dropColumn('item_cat', 'rgt');
        $this->dropColumn('item_cat', 'depth');
        $this->dropColumn('item_cat', 'tree');
    }

}
