<?php

use yii\db\Migration;

/**
 * Handles the creation of table `appointment`.
 */
class m180704_042429_create_appointment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%appointment}}', [
            'id' => $this->primaryKey(),
            'platform' => $this->string(255)->defaultValue(NULL)->comment('购买平台'),
            'enter_type' => $this->integer()->defaultValue(1)->comment('输入方式，1-手动输入，2-上传截图'),
            'code' => $this->string(255)->comment('手动输入的团购券'),
            'clothes_count' => $this->integer()->defaultValue(0)->comment('衣服数量'),
            'userName' => $this->string(255)->defaultValue(NULL)->comment('收件人姓名'),
            'province' => $this->string(32)->defaultValue(NULL)->comment('省'),
            'city' => $this->string(32)->defaultValue(NULL)->comment('市'),
            'county' => $this->string(255)->defaultValue(NULL)->comment('区'),
            'street' => $this->string(255)->defaultValue(NULL)->comment('详细地址'),
            'postal_code' => $this->string(255)->defaultValue(NULL)->comment('邮编'),
            'tel_number' => $this->string(255)->defaultValue(NULL)->comment('电话号码'),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultValue(null)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%appointment}}');
    }
}
