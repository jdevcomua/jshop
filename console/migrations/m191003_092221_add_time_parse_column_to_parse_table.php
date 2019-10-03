<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%parse}}`.
 */
class m191003_092221_add_time_parse_column_to_parse_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addColumn('parse', 'parse_time', $this->string()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {

        $this->dropColumn('parse', 'parse_time');

    }
}
