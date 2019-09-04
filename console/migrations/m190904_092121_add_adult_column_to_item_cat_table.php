<?php

use yii\db\Migration;

/**
 * Handles adding adult to table `{{%item_cat}}`.
 */
class m190904_092121_add_adult_column_to_item_cat_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addColumn('item_cat', 'adult', $this->boolean()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {

        $this->dropColumn('item_cat', 'adult');

    }
}
