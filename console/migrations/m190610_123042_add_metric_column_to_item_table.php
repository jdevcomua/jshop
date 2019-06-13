<?php

use yii\db\Migration;

/**
 * Handles adding metric to table `{{%item}}`.
 */
class m190610_123042_add_metric_column_to_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->renameColumn('user', 'mail','email');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->renameColumn('user', 'email','mail');
    }
}
