<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%wx_order_notify}}".
 *
 * @property int $id
 * @property string $out_trade_no 商户订单号
 * @property string $openid 用户标识
 * @property string $time_end 支付完成时间
 * @property int $total_fee 订单金额
 * @property string $bank_type 付款银行
 * @property string $appid 小程序appid
 * @property int $cash_fee 现金支付金额
 * @property string $fee_type 货币种类
 * @property string $is_subscribe 用户是否关注公众账号，Y-关注 N-未关注
 * @property string $mac_id 微信支付分配的商户号
 * @property string $nonce_str 随机字符串
 * @property string $result_code 业务结果
 * @property string $return_code 返回码
 * @property string $err_code 错误代码
 * @property string $err_code_des 错误代码描述
 * @property string $sign 签名
 * @property string $trade_type 交易类型
 * @property string $transaction_id 微信支付订单号
 * @property string $created_at
 * @property string $updated_at
 */
class WxOrderNotify extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wx_order_notify}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['total_fee', 'cash_fee'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['out_trade_no', 'appid'], 'string', 'max' => 50],
            [['openid', 'err_code_des', 'sign'], 'string', 'max' => 128],
            [['time_end'], 'string', 'max' => 14],
            [['bank_type', 'mac_id', 'nonce_str', 'err_code', 'transaction_id'], 'string', 'max' => 32],
            [['fee_type'], 'string', 'max' => 8],
            [['is_subscribe'], 'string', 'max' => 1],
            [['result_code', 'return_code', 'trade_type'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'out_trade_no' => '商户订单号',
            'openid' => '用户标识',
            'time_end' => '支付完成时间',
            'total_fee' => '订单金额',
            'bank_type' => '付款银行',
            'appid' => '小程序appid',
            'cash_fee' => '现金支付金额',
            'fee_type' => '货币种类',
            'is_subscribe' => '用户是否关注公众账号，Y-关注 N-未关注',
            'mac_id' => '微信支付分配的商户号',
            'nonce_str' => '随机字符串',
            'result_code' => '业务结果',
            'return_code' => '返回码',
            'err_code' => '错误代码',
            'err_code_des' => '错误代码描述',
            'sign' => '签名',
            'trade_type' => '交易类型',
            'transaction_id' => '微信支付订单号',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
