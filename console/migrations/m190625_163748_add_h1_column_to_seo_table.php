<?php

use yii\db\Migration;

/**
 * Handles adding h1 to table `{{%seo}}`.
 */
class m190625_163748_add_h1_column_to_seo_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addColumn('seo', 'h1', $this->string(50));
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {

        $this->dropColumn('seo', 'h1');

    }
}
