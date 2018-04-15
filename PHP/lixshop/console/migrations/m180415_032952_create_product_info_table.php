<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product_info`.
 */
class m180415_032952_create_product_info_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // 产品信息表
        $this->createTable('{{%product_info}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull()->comment('产品名称'), //产品名称
            'spu' => $this->string(100)->defaultValue(NULL)->comment('标准化产品单元'),  
            'sku' => $this->string(100)->defaultValue(NULL)->comment('库存量单位'),
            'score' => $this->decimal(12, 2)->defaultValue(NULL)->comment('产品的评分'),
            'status' => $this->integer(5)->defaultValue(1)->comment('产品的状态，1代表激活，2代表下架'),
            'min_sales_qty' => $this->integer(5)->defaultValue(1)->comment('产品的最小销售个数'),
            'is_in_stock' => $this->integer(5)->defaultValue(1)->comment('产品 的库存状态，1代表有库存，2代表无库存'),
            'visibility' => $this->integer(5)->defaultValue(1)->comment('是否可见'),
            'url_key' => $this->string(255)->defaultValue(null)->comment('url地址'),
            'stock' => $this->integer(12)->defaultValue(null)->comment('库存数量'),
            // 'category', // 产品的分类id。可以多个
            'price' => $this->decimal(12, 2)->defaultValue(NULL)->comment('销售价格'),
            'cost_price' => $this->decimal(12, 2)->defaultValue(NULL)->comment('成本价格'),
            'final_price' => $this->decimal(12, 2)->defaultValue(NULL)->comment('最终价格'),
            'meta_title' => $this->string(255)->defaultValue(null)->comment('标题'),
            'meta_keywords' => $this->string(255)->defaultValue(null)->comment('关键词'),
            'meta_description' => $this->text()->comment('产品详情'),
            // 'image',
            // 'custom_option',    // 产品 custom option部分，也就是淘宝模式的颜色尺码这类属性
            'package_number' => $this->integer(5)->defaultValue(1)->comment('打包销售个数，譬如，值为5，则加入购物车的个数都是5的'),
            'created_user_id' => $this->integer(10)->defaultValue(null)->comment('创建产品的管理员id'),
            'reviw_rate_star_average' => $this->decimal(12, 2)->defaultValue(NULL)->comment('评论平均评分'),
            'review_count' => $this->integer(12)->defaultValue(0)->comment('评论的总数'),
            // 'reviw_rate_star_info',          // 评星详细，各个评星的个数
            'favorite_count' => $this->integer(12)->defaultValue(0)->comment('产品被收藏的次数'),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultValue(null)
        ]);

        // 产品图片表
        $this->createTable('{{%product_image}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(12)->notNull()->defaultValue(null)->comment('产品id'),
            'path' => $this->string(255)->defaultValue(null)->comment('存储路径'),
            'filename' => $this->string(255)->defaultValue(null)->comment('文件名'),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultValue(null)
        ]);

        // 总的分类表
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'category' => $this->string(255)->defaultValue(null)->comment('分类名'),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultValue(null)
        ]);

        // 产品分类表
        $this->createTable('{{%product_category}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(12)->notNull()->defaultValue(null)->comment('产品id'),
            'category_id' => $this->integer(12)->notNull()->defaultValue(null)->comment('分类id'),
            'category' => $this->string(255)->defaultValue(null)->comment('分类名'),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultValue(null)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product_info}}');
        $this->dropTable('{{%product_image}}');
        $this->dropTable('{{%category}}');
        $this->dropTable('{{%product_category}}');
    }
}
