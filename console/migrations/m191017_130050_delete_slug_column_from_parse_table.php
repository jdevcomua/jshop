<?php

use yii\db\Migration;

/**
 * Class m191017_130050_delete_slug_column_from_parse_table
 */
class m191017_130050_delete_slug_column_from_parse_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('parse','slug');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('parse','slug',$this->string());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191017_130050_delete_slug_column_from_parse_table cannot be reverted.\n";

        return false;
    }
    */
}
