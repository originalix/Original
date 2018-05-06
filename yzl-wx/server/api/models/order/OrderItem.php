<?php

namespace api\models\order;

use Yii;
use common\models\SalesFlatOrderItem;

class OrderItem extends SalesFlatOrderItem
{
    public function rules()
    {
        return [
            [['order_id', 'product_id', 'count', 'price', 'row_total'], 'required', 'message' => '{attribute}不能为空'],
            [['order_id', 'customer_id', 'product_id', 'count'], 'integer'],
            [['custom_option_key'], 'required'],
            [['price', 'row_total'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['custom_option_key', 'name', 'image', 'redirect_url'], 'string', 'max' => 255],
        ];
    }
}
