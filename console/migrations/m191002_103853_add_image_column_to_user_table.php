<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user}}`.
 */
class m191002_103853_add_image_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addColumn('user', 'image', $this->string()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {

        $this->dropColumn('user', 'image');

    }
}
