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

    public function rules()
    {
        return [
            [['name', 'spu', 'sku', 'min_sales_qty', 'final_price', 'meta_title', 'meta_description', 'meta_keywords', 'image'], 'required', 'message' => '{attribute}不能为空.'],
            ['is_in_stock', 'boolean'],
            ['name', 'string', 'min' => 2, 'max' => 150, 'message' => '名称长度必须在2-150个字符之间'],
        ];
    }

    public function createProduct()
    {
        if (!$this->validate()) {
            return null;
        }

        $product = new Product();
        $product->name = $this->name;
        $product->spu = $this->spu;
        $product->sku = $this->sku;
        $product->min_sales_qty = $this->min_sales_qty;

        return $product->save() ? $product : null;
    }
}
