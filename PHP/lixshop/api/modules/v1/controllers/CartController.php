<?php

namespace api\modules\v1\controllers;

use Yii;
use api\components\BaseController;
use api\models\cart\Cart;
use api\models\cart\CartItem;

class CartController extends BaseController
{
    /**
     * 添加商品进入购物车
     *
     * @return void
     */
    public function actionCreate()
    {
        $uid = Yii::$app->user->identity->id;
        $cart = Cart::findByCustomerId($uid);
        if (is_null($cart)) {
            $cart = Cart::createRow();
        }

        $request = Yii::$app->request;
        $cartItem = CartItem::findItemByCartIdAndProductId($cart->id, $request->post('id'));
        if (is_null($cartItem)) {
            $cartItem = new CartItem();
        }

        $cartItem->cart_id = $cart->id;
        $cartItem->product_id = $request->post('id');
        $cartItem->count = $request->post('count');
        $cartItem->custom_option_key = $request->post('custom_key');
        $cartItem->active = $request->post('active');
        
        $cartItem->saveItem();
        
        return null;
    }    
}
