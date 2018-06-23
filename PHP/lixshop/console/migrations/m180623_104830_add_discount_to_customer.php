<?php

use yii\db\Migration;

/**
 * Class m180623_104830_add_discount_to_customer
 */
class m180623_104830_add_discount_to_customer extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%customer}}', 'discount', $this->integer(3)->defaultValue(100)->comment('用户享受的会员折扣'));
        $this->addColumn('{{%customer}}', 'name', $this->string(255)->defaultValue(NULL)->comment('顾客姓名'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180623_104830_add_discount_to_customer cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180623_104830_add_discount_to_customer cannot be reverted.\n";

        return false;
    }
    */
}
