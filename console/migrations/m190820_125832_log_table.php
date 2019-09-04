<?php

use yii\db\Migration;

/**
 * Class m190820_125832_log_table
 */
class m190820_125832_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('{{%log}}');
        $tableOption = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        $this->createTable('{{%log}}', [
            'id' => $this->primaryKey(),
            'date'=>'timestamp default CURRENT_TIMESTAMP',
            'message'=>$this->text(),
        ],$tableOption);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%log}}');
        $tableOption = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('{{%log}}', [
            'id' => $this->primaryKey(),
            'date'=>'timestamp default CURRENT_TIMESTAMP',
            'message'=>$this->text(),
        ],$tableOption);
    }
}
