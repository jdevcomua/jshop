<?php

use yii\db\Schema;
use yii\db\Migration;

class m160129_195036_small_image extends Migration
{
    
    public function up()
    {
        $this->addColumn('image', 'small', 'varchar(100)');
    }

    public function down()
    {
        $this->dropColumn('{{%image}}', 'small');
    }

}
