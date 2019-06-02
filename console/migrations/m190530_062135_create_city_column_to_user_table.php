<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%city_column_to_user}}`.
 */
class m190530_062135_create_city_column_to_user_table extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'city', $this->integer()->null());
    }

    public function down()
    {
        $this->dropColumn('user', 'city');
    }
}
