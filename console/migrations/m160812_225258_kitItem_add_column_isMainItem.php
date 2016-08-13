<?php

use yii\db\Migration;

class m160812_225258_kitItem_add_column_isMainItem extends Migration
{
    public function up()
    {
        $this->addColumn('kit_item', 'is_main_item', $this->boolean());
    }

    public function down()
    {
        $this->dropColumn('kit_item', 'is_main_item');
    }

}
