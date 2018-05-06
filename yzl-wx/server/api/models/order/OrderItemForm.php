<?php

namespace api\models\order;

use Yii;
use yii\base\Model;
use yii\web\HttpException;
use api\models\order\OrderItem;
use api\models\product\ProductInfo;

class OrderItemForm extends Model
{   
    public $order_id;
    public $customer_id;
    public $product_id;
    public $custom_option_key;
    public $name;
    public $image;
    public $count;
    public $price;
    public $row_total;
    public $redirect_url;

    public function rules()
    {
        return [
            [['order_id', 'product_id', 'count', 'custom_option_key'], 'required', 'message' => '{attribute}不能为空'],
            [['order_id', 'customer_id', 'product_id', 'count'], 'integer'],
            [['custom_option_key'], 'required'],
            [['price', 'row_total'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['custom_option_key', 'name', 'image', 'redirect_url'], 'string', 'max' => 255],
        ];
    }

    // 每个产品 记录信息 保存model
    // 每个产品 按数量 减少库存
    // 对应的custom_option_key 库存减少
    public function saveWithOrder($order)
    {
        $this->order_id = $order->id;
        $this->customer_id = $order->customer_id;

        if (! $this->validate()) {
            throw new HttpException(418, '生成订单错误');
        }

        $product = ProductInfo::findOne($this->product_id);
        $imagePath = null;
        if (! empty($product->image)) {
            $imagePath = $product->image[0]->path;
        }
        $model = new OrderItem();
        $model->attributes = [
            'order_id' => $this->order_id,
            'customer_id' => $this->customer_id,
            'product_id' => $this->product_id,
            'custom_option_key' => $this->custom_option_key,
            'name' => $product->name,
            'image' => $imagePath,
            'count' => $this->count,
            'price' => $product->final_price,
            'row_total' => $this->count * $product->final_price,
            'redirect_url' => null,
        ];

        return $model->save();
    }
}
