<?php

use yii\db\Migration;

/**
 * Handles the creation of table `charge`.
 */
class m180610_063504_create_charge_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        // 充值商品表
        $this->createTable('{{%charge_product}}', [
            'id' => $this->primaryKey(),
            'amount' => $this->integer()->defaultValue(1)->comment('充值金额'),
            'gift' => $this->integer()->defaultValue(0)->comment('充值赠送金额'),
            'discount' => $this->integer()->defaultValue(100)->comment('充值折扣，请输入整数百分比'),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultValue(NULL),
        ]);

        // 充值订单表
        $this->createTable('{{%charge_order}}', [

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('charge');
    }
}
