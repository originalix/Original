<?php

namespace api\models\cart;

use Yii;
use common\models\SalesFlatCartItem;
use api\models\product\ProductInfo;
use api\models\cart\Cart;

class CartItem extends SalesFlatCartItem
{
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    public function getCart()
    {
        return $this->hasOne(Cart::className(), ['id' => 'cart_id']);
    }
}
