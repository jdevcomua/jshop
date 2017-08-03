<?php

use yii\db\Migration;

class m170802_212505_static_pages extends Migration
{

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%static_page}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'content' => $this->text(),
            'route' => $this->string(),
        ], $tableOptions);

        $this->batchInsert('{{%static_page}}', ['route', 'title'], [
            ['site/delivery', 'Доставка'],
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%static_page}}');
    }

}
