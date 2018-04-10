<?php

use yii\db\Migration;

/**
 * Handles the creation of table `admin`.
 */
class m180410_072951_create_admin_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%admin_user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(50)->notNull()->comment('管理员用户名'),
            'password_hash' => $this->string()->comment('密码hash'),
            'password_reset_token' => $this->string()->comment('重置密码令牌'),
            'person' => $this->string(10)->notNull()->defaultValue('')->comment('姓名'),
            'mobile' => $this->string(11)->notNull()->comment('手机号'),
            'auth_key' => $this->string()->comment('加密串'),
            'status' => $this->integer()->defaultValue(1)->comment('账号状态'),
            'access_token' => $this->string()->comment('登录令牌'),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultValue(null)
        ]);

        
    }

    public function down()
    {
        echo "m180410_071034_create_admin_table cannot be reverted.\n";

        $this->dropTable('{{%admin_user}}');
    }
}
