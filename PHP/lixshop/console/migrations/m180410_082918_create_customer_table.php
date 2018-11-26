<?php

use yii\db\Migration;

/**
 * Handles the creation of table `customer`.
 */
class m180410_082918_create_customer_table extends Migration
{
    public function up()
    {
        // 顾客表
        $this->createTable('{{%customer}}', [
            'id' => $this->primaryKey(),
            'wechat_openid' => $this->string(255)->comment('微信open_id'),
            'mobile' => $this->string(11)->comment('手机号码'),
            'group' => $this->integer()->defaultValue(1)->comment('客户类别 1、普通客户 2、学生'),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultValue(null),
            'access_token' => $this->string()->comment('登录令牌'),
            'favorite_product_count' => $this->integer()->defaultValue(0)->comment('收藏个数'),
            'access_token_created_at' => $this->timestamp()->defaultValue(null)
        ]);

        // 顾客地址表
        $this->createTable('{{%customer_address}}', [
            'id' => $this->primaryKey(),
            'customer_id' => $this->integer()->notNull()->comment('顾客id'),
            'name' => $this->string(100)->notNull()->comment('姓名'),
            'telephone' => $this->string(11)->notNull()->comment('电话'),
            'province' => $this->string(100)->notNull()->comment('省份'),
            'city' => $this->string(255)->notNull()->comment('城市'),
            'district' => $this->string(255)->notNull()->comment('区'),
            'street' => $this->string(255)->notNull()->comment('街道地址'),
            'is_default' => $this->boolean()->defaultValue(false)->comment('是否为默认地址'),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultValue(null),
        ]);
    }

    public function down()
    {
        echo "m180410_082918_create_customer_table cannot be reverted.\n";
        $this->dropTable('{{%product_flat_stock}}');
        $this->dropTable('{{%customer_address}}');
    }
}
