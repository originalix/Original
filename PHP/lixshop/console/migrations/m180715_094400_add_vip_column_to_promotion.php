<?php

use yii\db\Migration;

/**
 * Class m180715_094400_add_vip_column_to_promotion
 */
class m180715_094400_add_vip_column_to_promotion extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%sale_promotion}}', 'need_vip', $this->integer(2)->defaultValue(0)->comment('是否会员专享 1是 0否'));
        $this->addColumn('{{%product_info}}', 'sale_count', $this->integer()->defaultValue(0)->comment('产品销售数量'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180715_094400_add_vip_column_to_promotion cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180715_094400_add_vip_column_to_promotion cannot be reverted.\n";

        return false;
    }
    */
}
