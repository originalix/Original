<?php

use yii\db\Migration;

/**
 * Handles the creation of table `referees`.
 */
class m180629_023002_create_referees_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%referees}}', [
            'id' => $this->primaryKey(),
            'customer_id' => $this->integer(15)->defaultValue(NULL)->comment('用户id'),
            'referees_id' => $this->integer(15)->defaultValue(NULL)->comment('推荐人id'),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultValue(null)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%referees}}');
    }
}
