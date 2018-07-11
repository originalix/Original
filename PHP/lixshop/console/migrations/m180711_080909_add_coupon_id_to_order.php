<?php

use yii\db\Migration;

/**
 * Class m180711_080909_add_coupon_id_to_order
 */
class m180711_080909_add_coupon_id_to_order extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('{{%sales_flat_order}}', 'coupon_id', $this->integer()->defaultValue(NULL)->comment('优惠券关联id'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180711_080909_add_coupon_id_to_order cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180711_080909_add_coupon_id_to_order cannot be reverted.\n";

        return false;
    }
    */
}
