<?php

namespace api\modules\v1\controllers;

use Yii;
use api\components\BaseController;
use common\models\SlideShow;
use common\models\Category;
// use common\models\SalePromotion;
use api\models\product\SalePromotion;
use yii\data\ActiveDataProvider;
use common\models\Referees;


class HomeController extends BaseController
{
    public function actionIndex()
    {
        //轮播图
        $slideShows = SlideShow::find()
            ->where(['is_usage' => 1])
            ->all();
        // 分类列表
        $categories = Category::find()->all();
        // 优惠爆品
        $salePromotions = $this->getSaleProduction();
        // 底部类目
        // 服务介绍、服务范围、价目中心、团体洗衣
        $bottom = $this->getBottom();

        // 推荐数量查询
        $uid = Yii::$app->user->identity->id;
        $referees_count = Referees::find()
        ->where(['referees_id' => $uid])
        ->count();

        return [
            'slideshow' => $slideShows, 
            'categories' => $categories, 
            'promotions' => $salePromotions,
            'bottom' => $bottom,
            'tips' => '你好！欢迎来到衣之恋优质干洗互联网下单平台。本公司下单即可享受免费上门取送，会员充值价格更优惠，推荐好友即可享受10-30元减免！',
            'share_count' => $referees_count,
        ];
    }

    protected function getBottom()
    {
        return [
            [
                'title' => '服务介绍',
                'redirect' => '',
                'icon' => '',
            ],
            [
                'title' => '服务范围',
                'redirect' => '',
                'icon' => '',
            ],
            [
                'title' => '价目中心',
                'redirect' => '',
                'icon' => '',
            ],
            [
                'title' => '团体洗衣',
                'redirect' => '',
                'icon' => '',
            ],
        ];
    }

    protected function getSaleProduction()
    {
        $query = SalePromotion::find();
        $query->with('product');
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        return $dataProvider->getModels();
    }
}
