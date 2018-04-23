<?php

namespace api\models\cart;

use Yii;
use common\models\SalesFlatCartItem;
use api\models\product\ProductInfo;
use api\models\cart\Cart;
use yii\web\HttpException;

class CartItem extends SalesFlatCartItem
{
    public static function findItemByCartIdAndProductId($cart_id, $product_id)
    {
        return static::find()
            ->where(['cart_id' => $cart_id])
            ->andWhere(['product_id' => $product_id])
            ->one();
    }

    public function saveItem()
    {
        if (! $this->validate()) {
            throw new HttpException(418, array_values($this->getFirstErrors())[0]);
        }

        return $this->saveItem();
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    public function getCart()
    {
        return $this->hasOne(Cart::className(), ['id' => 'cart_id']);
    }
}
