<?php

use yii\db\Migration;

class m170729_211231_alter_user extends Migration
{

    public function safeUp()
    {
        $this->dropColumn('{{%user}}', 'password');
        $this->dropColumn('{{%user}}', 'username');
    }

    public function safeDown()
    {
        $this->addColumn('{{%user}}', 'password', $this->string());
        $this->addColumn('{{%user}}', 'username', $this->string());
    }

}
