<?php

use yii\db\Migration;

/**
 * Class m180624_035003_add_cardId_to_customer
 */
class m180624_035003_add_cardId_to_customer extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%customer}}', 'card_id', $this->integer(32)->defaultValue(NULL)->comment('会员卡号'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180624_035003_add_cardId_to_customer cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180624_035003_add_cardId_to_customer cannot be reverted.\n";

        return false;
    }
    */
}
