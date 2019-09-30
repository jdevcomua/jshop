<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%latter}}`.
 */
class m190925_103238_create_letter_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%letter}}', [
            'id' => $this->primaryKey(),
            'letter' => $this->text(),
            'email' => $this->string()->null(),
            'phone' => $this->string()->null(),
            'name' => $this->string()->null(),
            'order_id' => $this->integer()->null(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%letter}}');
    }
}
