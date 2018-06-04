<?php

use yii\db\Migration;

/**
 * Class m180604_082340_add_address_to_lx_sales_flat_order
 */
class m180604_082340_add_address_to_lx_sales_flat_order extends Migration
{
    /**
     * 使用微信自带地址，所以去除地址表，直接将地址字段 插入订单表中
     * 并且增加订单号字段，用于微信商户内部订单号
     * 
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addColumn('{{%sales_flat_order}}', 'trade_no', $this->string(32)->defaultValue(NULL)->comment('32位以内订单编号'));
        $this->dropColumn('{{%sales_flat_order}}', 'address_id');
        $this->addColumn('{{%sales_flat_order}}', 'userName', $this->string(32)->defaultValue(NULL)->comment('收件人姓名'));
        $this->addColumn('{{%sales_flat_order}}', 'province', $this->string(32)->defaultValue(NULL)->comment('省'));
        $this->addColumn('{{%sales_flat_order}}', 'city', $this->string(32)->defaultValue(NULL)->comment('市'));
        $this->addColumn('{{%sales_flat_order}}', 'county', $this->string(32)->defaultValue(NULL)->comment('区'));
        $this->addColumn('{{%sales_flat_order}}', 'street', $this->string(255)->defaultValue(NULL)->comment('详细地址'));
        $this->addColumn('{{%sales_flat_order}}', 'postal_code', $this->string(32)->defaultValue(NULL)->comment('邮编'));
        $this->addColumn('{{%sales_flat_order}}', 'tel_number', $this->string(32)->defaultValue(NULL)->comment('电话号码'));
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        echo "m180604_081241_add_address_to_order cannot be reverted.\n";

        return false;
    }
}
