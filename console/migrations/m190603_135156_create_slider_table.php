<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%slider}}`.
 */
class m190603_135156_create_slider_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $tableOption = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('{{%slider}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->Null(),
            'largeTitle' => $this->string()->Null(),
            'description' => $this->string()->Null(),
            'image'=>$this->string()->Null(),
            'type'=>$this->integer()->Null(),
        ],$tableOption);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%slider}}');
    }
}
