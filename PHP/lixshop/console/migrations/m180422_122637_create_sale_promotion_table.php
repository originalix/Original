<?php

use yii\db\Migration;

/**
 * Handles the creation of table `sale_promotion`.
 */
class m180422_122637_create_sale_promotion_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // 创建爆款商品表
        $this->createTable('{{%sale_promotion}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->defaultValue(NULL)->comment('产品id'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('sale_promotion');
    }
}
