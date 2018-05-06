<?php

use yii\db\Migration;

/**
 * Handles the creation of table `balance`.
 */
class m180423_015953_create_balance_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // 创建顾客余额表
        $this->createTable('{{%balance}}', [
            'id' => $this->primaryKey(),
            'customer_id' => $this->integer()->notNull()->comment('顾客id'),
            'balance' => $this->decimal(12, 2)->defaultValue(NULL)->comment('余额'),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultValue(null)
        ]);
        
        // 消费日志表
        $this->createTable('{{%consume_log}}', [
            'id' => $this->primaryKey(),
            'customer_id' => $this->integer()->notNull()->comment('顾客id'),
            'consume' => $this->decimal(12, 2)->defaultValue(NULL)->comment('消费金额'),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultValue(null)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('balance');
    }
}
