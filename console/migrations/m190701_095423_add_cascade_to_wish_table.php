<?php

use yii\db\Migration;

/**
 * Class m190701_095423_add_cascade_to_wish_table
 */
class m190701_095423_add_cascade_to_wish_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->dropForeignKey('wish_list', 'wish');
        $this->addForeignKey('wish_list', 'wish', 'list_id','wish_list','id','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropForeignKey('wish_list', 'wish');
        $this->addForeignKey('wish_list', 'wish', 'list_id','wish_list','id');
    }


}
