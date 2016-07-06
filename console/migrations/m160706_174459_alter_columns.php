<?php

use yii\db\Migration;

class m160706_174459_alter_columns extends Migration
{

    public function up()
    {
        $this->alterColumn('orders', 'user_id', $this->integer());
        $this->alterColumn('characteristic_item', 'value', $this->string());
        $this->alterColumn('characteristic', 'title', $this->string());
    }

    public function down()
    {
        $this->alterColumn('orders', 'user_id', 'int not null');
        $this->alterColumn('characteristic_item', 'value', $this->string(50));
        $this->alterColumn('characteristic', 'title', $this->string(50));
    }

}
