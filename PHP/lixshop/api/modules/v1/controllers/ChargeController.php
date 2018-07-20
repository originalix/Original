<?php

namespace api\modules\v1\controllers;

use Yii;
use api\components\BaseController;
use api\models\charge\ChargeProductSearch;
use api\models\charge\ChargeOrderForm;
use api\models\charge\ChargePay;
use api\utils\Code;

class ChargeController extends BaseController
{
    /**
     * 获取充值金额列表
     *
     * @return array 充值列表
     */
    public function actionList()
    {
        $model = new ChargeProductSearch();
        return $model->search();
    }

    // mock 充值数据
    public function actionMock()
    {
        $model = new ChargeProductSearch();
        return $model->mock();
    }

    public function actionCard()
    {
        $code = new Code();
        $card_no = $code->encodeID(1, 5); 
        $card_pre = '121'; 
        $card_vc = substr(md5($card_pre.$card_no),0,2); 
        $card_vc = strtoupper($card_vc); 
        return $card_pre.$card_no.$card_vc; 
    }

    /**
     * 创建充值订单
     *
     * @return void
     */
    public function actionCreate()
    {
        $model = new ChargeOrderForm();
        if (! $model->load(Yii::$app->request->post(), '')) {
            throw new \yii\web\HttpException(421, '创建充值订单失败');
        }

        return $model->create();
    }

    /**
     * 发起余额支付
     *
     * @return void
     */
    public function actionPay()
    {
        $model = new ChargePay();
        if (! $model->load(Yii::$app->request->post(), '')) {
            throw new \yii\web\HttpException(421, '余额支付发起失败');
        }

        return $model->main();
    }

    /**
     * 补差价类型的余额扣款
     *
     * @return void
     */
    public function actionPayment()
    {
        
    }
}
