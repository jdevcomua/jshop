<?php

use yii\db\Migration;

class m160818_214244_create_table_banners extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('banner', [
            'id' => $this->primaryKey(),
            'image' => $this->string(),
            'url' => $this->string(),
            'position' => $this->string(),
            'enable' => $this->boolean(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('banner');
    }

}
