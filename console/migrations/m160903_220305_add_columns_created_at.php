<?php

use yii\db\Migration;

class m160903_220305_add_columns_created_at extends Migration
{
    
    public function up()
    {
        $this->addColumn('user', 'created', $this->timestamp()->defaultExpression('NOW()'));
    }

    public function down()
    {
        $this->dropColumn('user', 'created');
    }

}
