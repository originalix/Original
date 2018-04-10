<?php

use yii\db\Migration;

/**
 * Handles the creation of table `admin`.
 */
class m180410_072951_create_admin_table extends Migration
{
    public function up()
    {
        // 管理员用户表
        $this->createTable('{{%admin_user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(50)->notNull()->comment('管理员用户名')->unique(),
            'password_hash' => $this->string()->comment('密码hash'),
            'password_reset_token' => $this->string()->comment('重置密码令牌'),
            'person' => $this->string(10)->notNull()->defaultValue('')->comment('姓名'),
            'mobile' => $this->string(11)->notNull()->comment('手机号'),
            'auth_key' => $this->string()->comment('加密串'),
            'status' => $this->integer()->defaultValue(1)->comment('账号状态'),
            'access_token' => $this->string()->comment('登录令牌')->unique(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultValue(null)
        ]);
        
        // 管理员权限表
        $this->createTable('{{%admin_role}}', [
            'id' => $this->primaryKey(),
            'role_name' => $this->string(100)->notNull()->comment('权限名称'),
            'role_description' => $this->text()->comment('权限描述')
        ]);

        // 管理员用户权限表
        $this->createTable('{{%admin_user_role}}', [
            'id' => $this->primaryKey(),
            'admin_id' => $this->integer()->notNull()->comment('管理员id'),
            'role_id' => $this->integer()->notNull()->comment('对应权限id'),
        ]);

        // 后台用户访问记录表
        $this->createTable('{{%admin_visit_log}}', [
            'id' => $this->primaryKey(),
            'account' => $this->string(32)->notNull()->comment('管理员用户名'),
            'person' => $this->string(32)->defaultValue('')->comment('姓名'),
            'created_at' => $this->timestamp(),
            'menu' => $this->string(100)->defaultValue(NULL)->comment('菜单'),
            'url' => $this->text()->comment('URL'),
            'url_key' => $this->string(150)->defaultValue(NULL)->comment('参数')
        ]);
    }

    public function down()
    {
        echo "m180410_071034_create_admin_table cannot be reverted.\n";

        $this->dropTable('{{%admin_user}}');
    }
}
