<?php

namespace api\models\charge;

use Yii;
use yii\base\Model;
use yii\web\HttpException;
use yii\db\Exception;
use api\models\charge\ChargeOrder;
use common\models\ChargeProduct;
use api\filters\HttpApiAuth;
use common\models\Customer;
use common\models\BalanceLog;
use api\utils\Code;

class ChargeOrderForm extends Model
{
    const CHOOSE_CHARGE_PRODUCT = 1; // 选择商品列表的充值方式
    const INPUT_CHARGE_AMOUNT = 2;  // 手动输入金额的充值方式

    public $type;
    public $product_id = null;
    public $input_amount = null;
    public $trade_no;
    public $total_amount = 0;
    public $discount_amount = 0;
    public $real_amount = 0;
    public $customer_id;
    public $customer_group;
    public $remote_ip;
    public $payment_method;
    public $enjoy_discounts;

    public function rules()
    {
        return [
           [['type'], 'required', 'message' => '{attribute}未提交'],
           [['type', 'product_id'], 'integer'],
           [['input_amount'], 'number'],
        ];
    }

    public function create()
    {
        if (!$this->validate()) {
            throw new HttpException(418, array_values($this->getFirstErrors())[0]);
        }

        // type 为1 读取充值商品表 为属性赋值
        if ($this->type === static::CHOOSE_CHARGE_PRODUCT) {
            if (is_null($this->product_id)) {
                throw new HttpException(201, '商品参数缺失');
            }

            $product = ChargeProduct::findOne($this->product_id);
            if (is_null($product)) {
                throw new HttpException(202, '充值商品查询失败');
            }
            
            // 如果没有折扣 按赠送商品来算值
            if ($product->discount == 100) {
                $this->total_amount = $product->amount + $product->gift;
                $this->discount_amount = $product->gift;
                $this->real_amount = $product->amount;
            } else {
                $this->total_amount = $product->amount + $product->gift;
                $this->real_amount = $product->amount * ($product->discount / 100);
                $this->discount_amount = $this->total_amount - $this->real_amount;
            }

            $this->enjoy_discounts = $product->user_discount;

        } else if ($this->type === static::INPUT_CHARGE_AMOUNT) {
            // type 为2 自己为属性赋值 
            if (is_null($this->input_amount)) {
                throw new HttpException(202, '未输入商品金额');
            }

            $this->total_amount = $this->input_amount;
            $this->real_amount = $this->input_amount;
            $this->discount_amount = 0;
            $this->enjoy_discounts = 100;
        }

        // 生成订单号
        $this->trade_no = $this->generatorTradeNo();
        $order = $this->createOrderModel();

        // 开启事务
        $transaction = Yii::$app->db->beginTransaction();

        try {
            // 保存订单
            if (! $order->save()) {
                throw new HttpException(421, array_values($order->getFirstErrors())[0]);
            }

            // TODO: 保存消费日志

            // TODO: 更新用户余额字段

            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollBack();
            throw new HttpException(421, $e->getMessage());
        }

        return $order->attributes;
    }

    protected function createOrderModel()
    {
        $model = new ChargeOrder();
        $model->setAttributes([
            'trade_no' => $this->trade_no,
            'order_status' => 1,
            'total_amount' => $this->total_amount,
            'discount_amount' => $this->discount_amount,
            'real_amount' => $this->real_amount,
            'customer_id' => Yii::$app->user->identity->id,
            'remote_ip' => Yii::$app->request->userIP,
            'enjoy_discounts' => $this->enjoy_discounts,
        ]);

        return $model;
    }

    protected function generatorTradeNo()
    {
        return date('Ymd', time()).time().mt_rand(1000,9999);
    }

    protected function generatorCardId()
    {
        $customer = Customer::findOne(Yii::$app->user->identity->id);
        if (is_null($customer->card_id)) {
            $code = new Code();
            $card_no = $code->encodeID(1, 5); 
            $card_pre = '121'; 
            $card_vc = substr(md5($card_pre.$card_no),0,2); 
            $card_vc = strtoupper($card_vc); 
            $card_id =  $card_pre.$card_no.$card_vc; 
            $customer->card_id = $card_id;
            $customer->save();
        }
    }
}
