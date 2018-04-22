<?php

namespace api\modules\v1\controllers;

use Yii;
use api\components\BaseController;
use common\models\SlideShow;
use common\models\Category;


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

        // 底部类目
        // 服务介绍、服务范围、价目中心、团体洗衣
        $bottom = $this->getBottom();

        return [
            'slideshow' => $slideShows, 
            'categories' => $categories, 
            'bottom' => $bottom,
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
}
