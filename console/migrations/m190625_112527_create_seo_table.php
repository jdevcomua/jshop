<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%seo}}`.
 */
class m190625_112527_create_seo_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $tableOption = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('{{%seo}}', [
            'id' => $this->primaryKey()->Null(),
            'title'=>$this->string(50)->Null(),
            'description'=>$this->string(255)->Null(),
            'keywords'=>$this->string(255)->Null(),
            'url'=>$this->string(255)->Null(),
        ],$tableOption);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%seo}}');
    }
}
