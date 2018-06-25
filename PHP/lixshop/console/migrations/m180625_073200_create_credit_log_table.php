<?php

use yii\db\Migration;

/**
 * Handles the creation of table `credit_log`.
 */
class m180625_073200_create_credit_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%credit_log}}', [
            'id' => $this->primaryKey(),
            'customer_id' => $this->integer(15)->defaultValue(NULL)->comment('顾客id'),
            'type' => $this->integer(2)->defaultValue(NULL)->comment('积分使用类型，1获取，2使用'),
            'amount' => $this->decimal(12, 2)->defaultValue(NULL)->comment('使用数量'),
            'mark' => $this->string(255)->defaultValue(NULL)->comment('消费描述'),
            'balance' => $this->decimal(12, 2)->defaultValue(NULL)->comment('当前余额'),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultValue(null)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%credit_log}}');
    }
}
