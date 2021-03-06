<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%log}}`.
 */
class m190701_135248_create_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOption = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
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
    }
}
