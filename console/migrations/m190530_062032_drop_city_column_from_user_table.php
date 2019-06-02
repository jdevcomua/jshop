<?php

use yii\db\Migration;

/**
 * Handles dropping city from table `{{%user}}`.
 */
class m190530_062032_drop_city_column_from_user_table extends Migration
{
    public function up()
    {
        $this->dropColumn('user', 'city');
    }

    public function down()
    {
        $this->addColumn('user', 'city', $this->string());
    }
}
