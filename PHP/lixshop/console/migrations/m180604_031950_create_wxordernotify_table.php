<?php

use yii\db\Migration;

/**
 * Handles the creation of table `wxordernotify`.
 */
class m180604_031950_create_wxordernotify_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%wx_order_notify}}', [
            'id' => $this->primaryKey(),
            'out_trade_no' => $this->string(50)->defaultValue(NULL)->comment('商户订单号'),
            'bank_type' => $this->string(32)->defaultValue(NULL)->comment('付款银行'),
            'appid' => $this->string(50)->defaultValue(NULL)->comment('小程序appid'),
            'cash_fee' => $this->integer(15)->defaultValue(NULL)->comment('现金支付金额'),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('wxordernotify');
    }
}
