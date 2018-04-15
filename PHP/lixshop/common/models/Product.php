<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;


/**
 * This is the model class for table "{{%product_info}}".
 *
 * @property int $id
 * @property string $name 产品名称
 * @property string $spu 标准化产品单元
 * @property string $sku 库存量单位
 * @property string $score 产品的评分
 * @property int $status 产品的状态，1代表激活，2代表下架
 * @property int $min_sales_qty 产品的最小销售个数
 * @property int $is_in_stock 产品 的库存状态，1代表有库存，2代表无库存
 * @property int $visibility 是否可见
 * @property string $url_key url地址
 * @property int $stock 库存数量
 * @property string $price 销售价格
 * @property string $cost_price 成本价格
 * @property string $final_price 最终价格
 * @property string $meta_title 标题
 * @property string $meta_keywords 关键词
 * @property string $meta_description 产品详情
 * @property int $package_number 打包销售个数，譬如，值为5，则加入购物车的个数都是5的
 * @property int $created_user_id 创建产品的管理员id
 * @property string $reviw_rate_star_average 评论平均评分
 * @property int $review_count 评论的总数
 * @property int $favorite_count 产品被收藏的次数
 * @property string $created_at
 * @property string $updated_at
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {        
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',// 自己根据数据库字段修改
                'updatedAtAttribute' => 'updated_at', // 自己根据数据库字段修改
                'value' => new Expression('NOW()'), // 自己根据数据库字段修改
            ],
        ];   
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product_info}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['score', 'price', 'cost_price', 'final_price', 'reviw_rate_star_average'], 'number'],
            [['status', 'min_sales_qty', 'is_in_stock', 'visibility', 'stock', 'package_number', 'created_user_id', 'review_count', 'favorite_count'], 'integer'],
            [['meta_description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'url_key', 'meta_title', 'meta_keywords'], 'string', 'max' => 255],
            [['spu', 'sku'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '产品名称',
            'spu' => '标准化产品单元',
            'sku' => '库存量单位',
            'score' => '产品的评分',
            'status' => '产品的状态，1代表激活，2代表下架',
            'min_sales_qty' => '产品的最小销售个数',
            'is_in_stock' => '产品 的库存状态，1代表有库存，2代表无库存',
            'visibility' => '是否可见',
            'url_key' => 'url地址',
            'stock' => '库存数量',
            'price' => '销售价格',
            'cost_price' => '成本价格',
            'final_price' => '最终价格',
            'meta_title' => '标题',
            'meta_keywords' => '关键词',
            'meta_description' => '产品详情',
            'package_number' => '打包销售个数，譬如，值为5，则加入购物车的个数都是5的',
            'created_user_id' => '创建产品的管理员id',
            'reviw_rate_star_average' => '评论平均评分',
            'review_count' => '评论的总数',
            'favorite_count' => '产品被收藏的次数',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
