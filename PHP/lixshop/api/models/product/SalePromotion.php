<?php
namespace api\models\product;

use Yii;
use common\models\SalePromotion as PromotionModel;
use api\models\product\ProductInfo;

class SalePromotion extends PromotionModel
{
    public function getProduct()
    {
        return $this->hasOne(ProductInfo::className(), ['id' => 'product_id']);
    }
}
