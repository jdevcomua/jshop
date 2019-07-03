<?php

use yii\db\Migration;

/**
 * Handles adding new_url to table `{{%seo}}`.
 */
class m190703_135729_add_new_url_column_to_seo_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addColumn('seo', 'new_url', $this->string(255)->Null());
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {

        $this->dropColumn('seo', 'new_url');

    }
}
