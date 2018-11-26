<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%review}}".
 *
 * @property int $id
 * @property string $product_id 产品id
 * @property string $product_custom_option_key 产品自定义属性key
 * @property int $rate_star 评分
 * @property string $name 评论姓名
 * @property int $customer_id 顾客id
 * @property string $ip ip地址
 * @property string $summary 评论摘要
 * @property string $review_content 评论内容
 * @property string $review_data 评论时间
 * @property int $status 评论审核状态，10是默认状态，1是审核通过，2是审核拒绝
 * @property string $audit_user 评论后台审核人
 * @property string $audit_date 审核时间
 */
class Review extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%review}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rate_star', 'customer_id', 'status'], 'integer'],
            [['review_content'], 'string'],
            [['review_data', 'audit_date'], 'safe'],
            [['product_id', 'summary'], 'string', 'max' => 255],
            [['product_custom_option_key', 'name', 'audit_user'], 'string', 'max' => 100],
            [['ip'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => '产品id',
            'product_custom_option_key' => '产品自定义属性key',
            'rate_star' => '评分',
            'name' => '评论姓名',
            'customer_id' => '顾客id',
            'ip' => 'ip地址',
            'summary' => '评论摘要',
            'review_content' => '评论内容',
            'review_data' => '评论时间',
            'status' => '评论审核状态，10是默认状态，1是审核通过，2是审核拒绝',
            'audit_user' => '评论后台审核人',
            'audit_date' => '审核时间',
        ];
    }
}
