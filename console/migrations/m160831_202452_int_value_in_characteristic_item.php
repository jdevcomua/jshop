<?php

use yii\db\Migration;

class m160831_202452_int_value_in_characteristic_item extends Migration
{
    public function up()
    {
        $this->addColumn('characteristic_item', 'float_value', $this->float());
    }

    public function down()
    {
        $this->dropColumn('characteristic_item', 'float_value');
    }

}
