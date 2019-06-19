<?php

use yii\db\Migration;

/**
 * Handles adding parse_url to table `{{%item_cat}}`.
 */
class m190605_091733_add_parse_url_column_to_item_cat_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addColumn('item_cat', 'parse_url', $this->string()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropColumn('item_cat', 'parse_url');
    }
}
