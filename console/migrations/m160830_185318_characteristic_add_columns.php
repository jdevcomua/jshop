<?php

use yii\db\Migration;

class m160830_185318_characteristic_add_columns extends Migration
{
    public function up()
    {
        $this->addColumn('characteristic', 'type', 'integer');
    }

    public function down()
    {
        $this->dropColumn('characteristic', 'type');
    }

}
