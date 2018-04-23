<?php

namespace api\modules\v1\controllers;

use Yii;
use api\components\BaseController;
use api\models\cart\Cart;
use api\models\cart\CartItem;

class CartController extends BaseController
{   
    /**
     * 获取购物车列表
     *
     * @return void
     */
    public function actionIndex()
    {
        $uid = Yii::$app->user->identity->id;
        $cart = Cart::findByCustomerId($uid);
        if (is_null($cart)) {
            return null;
        }

        $cartItems = CartItem::find()
            ->where(['cart_id' => $cart->id])
            ->andWhere(['<>', 'count', 0])
            ->all();
        
        return $cartItems;
    }

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
        $items_count = $request->post('items_count');
        
        return $cartItem->saveItem($cart, $items_count);
    }

    /**
     * 从购物车 删除商品
     *
     * @return void
     */
    public function actionDelete()
    {
        $item_id = Yii::$app->request->getBodyParam('id');
        $cartItem = CartItem::findOne($item_id);
        if (is_null($cartItem)) {
            return null;
        }

        $count = $cartItem->count;
        $cart = Cart::findOne($cartItem->cart_id);
        $cart->items_count = $cart->items_count - $count;
        if ($cartItem->delete()) {
            return $cart->save();
        }

        return null;
    }
}
