<?php

use yii\db\Migration;

/**
 * Class m190930_120215_unicode_table_latter
 */
class m190930_120215_unicode_table_latter extends Migration
{
    /**
     * {@inheritdoc}
     */
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('{{%letter}}');
        $tableOption = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('{{%letter}}', [
            'id' => $this->primaryKey(),
            'letter' => $this->text(),
            'email' => $this->string()->null(),
            'phone' => $this->string()->null(),
            'name' => $this->string()->null(),
            'order_id' => $this->integer()->null(),
        ],$tableOption);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%letter}}');
        $this->createTable('{{%letter}}', [
            'id' => $this->primaryKey(),
            'letter' => $this->text(),
            'email' => $this->string()->null(),
            'phone' => $this->string()->null(),
            'name' => $this->string()->null(),
            'order_id' => $this->integer()->null(),
        ]);
    }
}
