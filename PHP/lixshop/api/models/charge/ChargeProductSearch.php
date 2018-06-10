<?php

namespace api\models\charge;

use Yii;
use common\models\ChargeProduct;
use yii\data\ActiveDataProvider;

class ChargeProductSearch extends ChargeProduct
{
    public function search()
    {
        return static::find()->all();
    }
}
