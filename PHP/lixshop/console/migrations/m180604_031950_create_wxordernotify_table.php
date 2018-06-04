<?php

use yii\db\Migration;

/**
 * Handles the creation of table `wxordernotify`.
 */
class m180604_031950_create_wxordernotify_table extends Migration
{
    /**
     * 创建微信支付订单表
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%wx_order_notify}}', [
            'id' => $this->primaryKey(),
            'out_trade_no' => $this->string(50)->defaultValue(NULL)->comment('商户订单号'),
            'openid' => $this->string(128)->defaultValue(NULL)->comment('用户标识'),
            'time_end' => $this->string(14)->defaultvalue(null)->comment('支付完成时间'),
            'total_fee' => $this->integer()->defaultValue(NULL)->comment('订单金额'),
            'bank_type' => $this->string(32)->defaultValue(NULL)->comment('付款银行'),
            'appid' => $this->string(50)->defaultValue(NULL)->comment('小程序appid'),
            'cash_fee' => $this->integer(15)->defaultValue(NULL)->comment('现金支付金额'),
            'fee_type' => $this->string(8)->defaultValue(NULL)->comment('货币种类'),
            'is_subscribe' => $this->string(1)->defaultValue(NULL)->comment('用户是否关注公众账号，Y-关注 N-未关注'),
            'mac_id' => $this->string(32)->defaultValue(NULL)->comment('微信支付分配的商户号'),
            'nonce_str' => $this->string(32)->defaultValue(NULL)->comment('随机字符串'),
            'result_code' => $this->string(16)->defaultvalue(null)->comment('业务结果'),
            'return_code' => $this->string(16)->defaultvalue(null)->comment('返回码'),
            'err_code' => $this->string(32)->defaultvalue(null)->comment('错误代码'),
            'err_code_des' => $this->string(128)->defaultvalue(null)->comment('错误代码描述'),
            'sign' => $this->string(128)->defaultvalue(null)->comment('签名'),
            'trade_type' => $this->string(16)->defaultvalue(null)->comment('交易类型'),
            'transaction_id' => $this->string(32)->defaultvalue(null)->comment('微信支付订单号'),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultValue(null),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%wx_order_notify}}');
    }
}
