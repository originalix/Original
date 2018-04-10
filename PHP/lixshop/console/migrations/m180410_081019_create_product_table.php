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
        $this->createTable('{{%product_flat_stock}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->comment('产品id'),
            'stock' => $this->integer()->comment('库存数量'),
        ]);

        $this->createTable('{{%product_custom_option_stock}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->comment('产品id'),
            'custom_option_key' => $this->string(255)->notNull()->comment('产品自定义的属性key'),
            'stock' => $this->integer()->comment('库存数量'),
        ]);

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
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultValue(null)
        ]);
        
        $this->createTable('{{%sales_coupon_usage}}', [
            'id' => $this->primaryKey(),
            'coupon_id' => $this->integer(15)->notNull()->comment('优惠券id'),
            'customer_id' => $this->integer(15)->notNull()->comment('顾客用户id'),
            'times_used' => $this->integer(15)->notNull()->comment('使用次数'),
        ]);

        // 购物车表
        $this->createTable('{{%sales_flat_cart}}', [
            
        ])
    }

    public function down()
    {

    }
}
