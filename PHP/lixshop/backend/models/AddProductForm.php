<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\mongodb\Product;

class AddProductForm extends Model
{
    public $name;
    public $spu;
    public $sku;
    public $min_sales_qty;
    public $is_in_stock = true;
    public $category;
    public $cost_price;
    public $final_price;
    public $meta_title;
    public $meta_keywords;
    public $meta_description;
    public $image;
    public $description;
    public $short_description;
    public $custom_option;
    public $package_number;
    public $created_user_id;
    
    private $_product;

}
