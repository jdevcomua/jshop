<?php

use yii\db\Migration;

class m160704_172357_password_hashing extends Migration
{
    
    public function up()
    {
        $this->addColumn('user', 'password_hash', 'string');
        $this->addColumn('user', 'password_reset_token', 'string');
        $this->addColumn('user', 'auth_key', 'string');
    }

    public function down()
    {
        $this->dropColumn('user', 'password_hash');
        $this->dropColumn('user', 'password_reset_token');
        $this->dropColumn('user', 'auth_key');
    }

}
