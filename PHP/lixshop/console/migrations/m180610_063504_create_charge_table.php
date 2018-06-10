<?php

use yii\db\Migration;

/**
 * Handles the creation of table `charge`.
 */
class m180610_063504_create_charge_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        // 充值商品表
        $this->createTable('{{%charge_product}}', [
            'id' => $this->primaryKey(),
            'amount' => $this->integer()->defaultValue(1)->comment('充值金额'),
            'gift' => $this->integer()->defaultValue(0)->comment('充值赠送金额'),
            'discount' => $this->integer()->defaultValue(100)->comment('充值折扣，请输入整数百分比'),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultValue(NULL),
        ]);

        // 充值订单表
        $this->createTable('{{%charge_order}}', [
            'id' => $this->primaryKey(),
            'trade_no' => $this->string(32)->defaultValue(NULL)->comment('订单号'),
            'order_status' => $this->integer(2)->defaultValue(1)->comment('订单状态，1未付款，2已付款，3已完成'),
            'total_amount' => $this->decimal(12, 2)->defaultValue(0)->comment('订单总价'),
            'discount_amount' => $this->decimal(12, 2)->defaultValue(NULL)->comment('折扣价格'),
            'real_amount' => $this->decimal(12, 2)->defaultValue(NULL)->comment('该订单的真实成交价格'),
            'customer_id' => $this->integer(15)->defaultValue(NULL)->comment('顾客id'),
            'customer_group' => $this->integer(15)->defaultValue(NULL)->comment('顾客分组'),
            'remote_ip' => $this->string(50)->comment('ip地址'),
            'payment_method' => $this->string(20)->defaultValue(NULL)->comment('支付方式'),
            'txn_id' => $this->string(30)->defaultValue(NULL)->comment('Transaction Id 支付平台唯一交易号,通过这个可以在第三方支付平台查找订单'),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultValue(null)
        ]);

        // 消费记录表
        $this->createTable('{{%balance_log}}', [
            'id' => $this->primaryKey(),
            'customer_id' => $this->integer(15)->defaultValue(NULL)->comment('顾客id'),
            'type' => $this->integer(2)->defaultValue(NULL)->comment('消费类型, 1消费，2充值'),
            'amount' => $this->integer(12)->defaultValue(NULL)->comment('消费金额'),
            'mark' => $this->string(255)->defaultValue(NULL)->comment('消费描述'),
            'balance' => $this->decimal(12, 2)->defaultValue(NULL)->comment('当前余额'),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultValue(null)
        ]);

        // 在用户表中 增加余额字段
        $this->addColumn('{{%customer}}', 'charge', $this->decimal(12, 2)->defaultValue(0.00)->comment('账户余额'));

    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%charge_product}}');
        $this->dropTable('{{%charge_order}}');
        $this->dropTable('{{%balance_log}}');
    }
}
