<?php

use yii\db\Migration;

/**
 * Class m191101_073006_round_cost_in_item_table
 */
class m191101_073006_round_cost_in_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $results = Yii::$app->db->createCommand("select id,cost from item")->queryAll();
        foreach ($results as $result){
            $result['cost'] = round ($result['cost'],2);
            $result['cost'] = ceil($result['cost']*10) / 10;
            $result['cost'] = round ($result['cost'],1);
            $sql = 'UPDATE item SET cost = '.$result['cost'].' WHERE id = '.$result['id'].';';
            $this->execute($sql);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191101_073006_round_cost_in_item_table cannot be reverted.\n";

        return false;
    }
    */
}
