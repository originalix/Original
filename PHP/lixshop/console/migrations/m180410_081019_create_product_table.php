<?php

use yii\db\Migration;
use fecshop\services\Page;

/**
 * Handles the creation of table `product`.
 */
class m180410_081019_create_product_table extends Migration
{
    public function up()
    {
        // 产品库存表
        $this->createTable('{{%product_flat_stock}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(15)->defaultValue(NULL)->comment('产品id'),
            'stock' => $this->integer()->comment('库存数量'),
        ]);

        // 产品custom option类型对应的库存信息
        $this->createTable('{{%product_custom_option_stock}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(15)->defaultValue(NULL)->comment('产品id'),
            'custom_option_key' => $this->string(255)->notNull()->comment('产品自定义的属性key'),
            'stock' => $this->integer()->comment('库存数量'),
            'price' => $this->decimal(12,2)->comment('对应价格'),
        ]);

        // 优惠券表
        $this->createTable('{{%sales_coupon}}', [
            'id' => $this->primaryKey(),
            'created_person' => $this->string(100)->notNull()->comment('创建人'),
            'coupon_name' => $this->string(255)->notNull()->comment('优惠券名称'),
            'coupon_description' => $this->text()->comment('优惠券描述'),
            'coupon_code' => $this->string(255)->notNull()->comment('优惠券码'),
            'expiration_date' => $this->timestamp()->defaultValue(null)->comment('过期时间'),
            'users_per_customer' => $this->integer()->comment('每个用户可以使用的次数'),
            'times_used' => $this->integer()->defaultValue(0)->comment('被使用的次数'),
            'type' => $this->integer(15)->defaultValue(NULL)->comment('优惠劵的类型，1代表按照百分比对产品打折，2代表在总额上减少多少'),
            'conditions' => $this->integer(15)->defaultValue(NULL)->comment('优惠劵使用的条件，如果类型为1，则没有条件，如果类型是2，则购物车中产品总额满足多少的时候进行打折。这里填写的是金额'),
            'discount' => $this->integer(15)->defaultValue(NULL)->comment('优惠劵的折扣，如果类型为1，这里填写的是百分比，如果类型是2，这里代表的是在总额上减少的金额'),
            'created_at' => $this->timestamp()->defaultValue(null),
            'updated_at' => $this->timestamp()->defaultValue(null)
        ]);
        
        // 优惠券使用表
        $this->createTable('{{%sales_coupon_usage}}', [
            'id' => $this->primaryKey(),
            'coupon_id' => $this->integer(15)->notNull()->comment('优惠券id'),
            'customer_id' => $this->integer(15)->notNull()->comment('顾客用户id'),
            'times_used' => $this->integer(15)->notNull()->comment('使用次数'),
        ]);

        // 购物车表
        $this->createTable('{{%sales_flat_cart}}', [
            'id' => $this->primaryKey(),
            'items_count' => $this->integer(15)->defaultValue(0)->comment('购物车中产品的总个数，默认为0个'),
            'customer_id' => $this->integer(15)->notNull()->comment('顾客id'),
            'customer_name' => $this->string(11)->comment('顾客姓名'),
            'customer_is_guest' => $this->boolean()->defaultValue(false)->comment('是否为游客身份'),
            'remote_ip' => $this->string(50)->comment('ip地址'),
            'coupon_code' => $this->string(50)->comment('优惠券码'),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultValue(null)
        ]);
        
        // 购物车项目表
        $this->createTable('{{%sales_flat_cart_item}}', [
            'id' => $this->primaryKey(),
            'cart_id' => $this->integer(15)->notNull()->comment('购物车关联id'),
            'product_id' => $this->integer(15)->defaultValue(NULL)->comment('产品id'),
            'count' => $this->integer(15)->defaultValue(1)->comment('加入购物车数量'),
            'custom_option_key' => $this->string(255)->comment('产品的自定义属性'),
            'active' => $this->integer(5)->defaultValue(2)->comment('1代表勾选，2代表不勾选'),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultValue(null)
        ]);
        
        // 订单表
        $this->createTable('{{%sales_flat_order}}', [
            'id' => $this->primaryKey(),
            'increment_id' => $this->integer()->defaultValue(0)->comment('自动增长id'),
            'order_status' => $this->integer()->defaultValue(0)->comment('订单状态，1待付款，2已付款，3已完成'),
            'items_count' => $this->integer()->defaultValue(1)->comment('订单商品数量'),
            'total_amount' => $this->decimal(12, 2)->defaultValue(0)->comment('订单总价'),
            'discount_amount' => $this->decimal(12, 2)->defaultValue(NULL)->comment('折扣价格'),
            'real_amount' => $this->decimal(12, 2)->defaultValue(NULL)->comment('该订单的真实成交价格'),
            'customer_id' => $this->integer(15)->defaultValue(NULL)->comment('顾客id'),
            'customer_group' => $this->integer(15)->defaultValue(NULL)->comment('顾客分组'),
            'customer_name' => $this->string(100)->defaultValue(NULL)->comment('顾客姓名'),
            'remote_ip' => $this->string(50)->comment('ip地址'),
            'coupon_code' => $this->string(255)->notNull()->comment('优惠券码'),
            'payment_method' => $this->string(20)->notNull()->comment('支付方式'),
            'address_id' => $this->integer(15)->defaultValue(NULL)->comment('关联地址id'),
            'order_remark' => $this->text()->comment('交易备注'),
            'txn_type' => $this->string(20)->defaultValue(NULL)->comment('Transaction类型，是在购物车点击支付按钮下单，还是在下单页面填写完货运地址信息下单'),
            'txn_id' => $this->string(30)->defaultValue(NULL)->comment('Transaction Id 支付平台唯一交易号,通过这个可以在第三方支付平台查找订单'),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultValue(null)
        ]);
        
        // 订单产品表
        $this->createTable('{{%sales_flat_order_item}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->defaultValue(NULL)->comment('关联的订单id'),
            'customer_id' => $this->integer(15)->defaultValue(NULL)->comment('顾客id'),
            'product_id' => $this->integer(15)->defaultValue(NULL)->comment('产品id'),
            'custom_option_key' => $this->string(255)->notNull()->comment('产品自定义的属性key'),
            'name' => $this->string(255)->defaultValue(NULL)->comment('产品名称'),
            'image' => $this->string(255)->defaultValue(NULL)->comment('封面图片'),
            'count' => $this->integer()->defaultValue(1)->comment('购买数量'),
            'price' => $this->decimal(12, 2)->defaultValue(NULL)->comment('产品单价'),
            'row_total' => $this->decimal(12, 2)->defaultValue(NULL)->comment('一个产品价格*个数'),
            'redirect_url' => $this->string(255)->defaultValue(NULL)->comment('封面图片'),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultValue(null)
        ]);
        
        // 产品收藏信息表
        $this->createTable('{{%favorite}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(15)->defaultValue(NULL)->comment('产品id'),
            'customer_id' => $this->integer()->defaultValue(NULL)->comment('顾客id'),
            'created_at' => $this->timestamp()->defaultValue(null),
            'updated_at' => $this->timestamp()->defaultValue(null)            
        ]);

        // 产品评论表
        $this->createTable('{{%review}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(15)->defaultValue(NULL)->comment('产品id'),
            'product_custom_option_key' => $this->string(100)->defaultValue(NULL)->comment('产品自定义属性key'),
            'rate_star' => $this->integer(5)->defaultValue(NULL)->comment('评分'),
            'name' => $this->string(100)->defaultValue(NULL)->comment('评论姓名'),
            'customer_id' => $this->integer(15)->defaultValue(NULL)->comment('顾客id'),
            'ip' => $this->string(50)->comment('ip地址'),
            'summary' => $this->string(255)->comment('评论摘要'),
            'review_content' => $this->text()->comment('评论内容'),
            'review_data' => $this->timestamp()->defaultValue(null)->comment('评论时间'),
            'status' => $this->integer(3)->defaultValue(10)->comment('评论审核状态，10是默认状态，1是审核通过，2是审核拒绝'),
            'audit_user' => $this->string(100)->defaultValue(NULL)->comment('评论后台审核人'),
            'audit_date' => $this->timestamp()->defaultValue(null)->comment('审核时间'),
        ]);
    }

    public function down()
    {
        echo "m180410_081019_create_product_table cannot be reverted.\n";
        $this->dropTable('{{%product_flat_stock}}');
        $this->dropTable('{{%product_custom_option_stock}}');
        $this->dropTable('{{%sales_coupon}}');
        $this->dropTable('{{%sales_coupon_usage}}');
        $this->dropTable('{{%sales_flat_cart}}');
        $this->dropTable('{{%sales_flat_cart_item}}');
        $this->dropTable('{{%sales_flat_order}}');
        $this->dropTable('{{%sales_flat_order_item}}');
        $this->dropTable('{{%favorite}}');
        $this->dropTable('{{%review}}');
    }
}
