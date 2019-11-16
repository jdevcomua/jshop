<?php

use yii\db\Migration;

/**
 * Class m191116_180506_images_date_time
 */
class m191116_180506_images_date_time extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('image', 'created_at', $this->timestamp());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('image', 'created_at');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191116_180506_images_date_time cannot be reverted.\n";

        return false;
    }
    */
}
