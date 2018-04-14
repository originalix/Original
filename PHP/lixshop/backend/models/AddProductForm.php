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
    public $stock;
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
            [['name', 'spu', 'sku', 'min_sales_qty', 'final_price', 'meta_title', 'meta_description', 'meta_keywords', 'cost_price'], 'required', 'message' => '{attribute}不能为空.'],
            ['is_in_stock', 'boolean'],
            ['name', 'string', 'min' => 2, 'max' => 150, 'message' => '名称长度必须在2-150个字符之间'],
            [['final_price', 'cost_price', 'min_sales_qty', 'stock', 'package_number'], 'number', 'message' => '{attribute}必须是数字'],
        ];
    }

    public function createProduct()
    {
        if (!$this->validate()) {
            print_r('not validate');
            print_r($this->meta_description);
            print_r($this->getFirstErrors());
            exit();
            return null;
        }

        $product = new Product();
        $product->name = $this->name;
        $product->spu = $this->spu;
        $product->sku = $this->sku;
        $product->min_sales_qty = $this->min_sales_qty;
        $product->stock = $this->stock;
        $product->is_in_stock = $this->is_in_stock;
        $product->category = $this->category;
        $product->price = $this->final_price;
        $product->cost_price = $this->cost_price;
        $product->final_price = $this->final_price;
        $product->meta_title = $this->meta_title;
        $product->meta_keywords = $this->meta_keywords;
        $product->meta_description = $this->meta_description;
        $product->image = array_values($this->image);
        $product->package_number = $this->package_number;
        $product->custom_option = $this->custom_option;
        $created_user_id = Yii::$app->user->identity->id;

        return $product->save() ? $product : null;
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '产品名称',
            'spu' => '标准化产品单元',  
            'sku' => '库存量单位',
            
            'score' => '产品的评分',   // 产品的评分
            'status' => '状态',  // 产品的状态，1代表激活，2代表下架
            'min_sales_qty' => '最小销售个数', // 产品的最小销售个数
            'stock' => '库存个数',
            'is_in_stock' => '库存状态', // 产品 的库存状态，1代表有库存，0代表无库存
            'visibility', // 是否可见
            'url_key', // url地址
            
            'category' => '产品分类id', // 产品的分类id。可以多个
            'price' => '产品销售价格', // 产品的销售价格
            'cost_price' => '成本价格', // 成本价格
            'final_price' => '最终价格',   // 算出来的最终价格。这个通过脚本赋值。
            'meta_title' => '标题',
            'meta_keywords' => '关键词',
            'meta_description' => '商品详情',
            'image' => '图片',
            'description' => '描述',
            'short_description' => '简介',
            'custom_option' => '自定义属性',    // 产品 custom option部分，也就是淘宝模式的颜色尺码这类属性
            'package_number' => '打包销售个数',  // 打包销售个数，譬如，值为5，则加入购物车的个数都是5的倍数。
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'created_user_id' => '创建人id',
        ];
    }
}
