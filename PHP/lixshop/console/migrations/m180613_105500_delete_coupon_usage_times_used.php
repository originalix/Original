<?php

use yii\db\Migration;

/**
 * Class m180613_105500_delete_coupon_usage_times_used
 */
class m180613_105500_delete_coupon_usage_times_used extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->dropColumn('{{%sales_coupon_usage}}', 'times_used');
        $this->addColumn('{{%sales_coupon_usage}}', 'is_used', $this->integer(1)->defaultValue(1)->comment('是否使用过,1未使用，2使用过'));
        $this->addColumn('{{%sales_coupon_usage}}', 'created_at', $this->timestamp());

        $this->addColumn('{{%sales_coupon_usage}}', 'updated_at', $this->timestamp()->defaultValue(NULL));
    }

    public function down()
    {
        echo "m180613_105500_delete_coupon_usage_times_used cannot be reverted.\n";

        return false;
    }
}
