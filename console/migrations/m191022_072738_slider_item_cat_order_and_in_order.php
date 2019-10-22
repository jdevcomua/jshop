<?php

use yii\db\Migration;

/**
 * Class m191022_072738_slider_item_cat_order_and_in_order
 */
class m191022_072738_slider_item_cat_order_and_in_order extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('item_cat','slider_order',$this->integer());
        $this->addColumn('item_cat','in_slider',$this->boolean()->defaultValue(1));
        $results = Yii::$app->db->createCommand("select id from item_cat")->queryAll();
        $order = 1;
        foreach ($results as $result){
            $sql = 'UPDATE item_cat SET slider_order = '.$order++.' WHERE id = '.$result['id'].';';
            $this->execute($sql);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('item_cat','in_slider');
        $this->dropColumn('item_cat','slider_order');
    }

}
