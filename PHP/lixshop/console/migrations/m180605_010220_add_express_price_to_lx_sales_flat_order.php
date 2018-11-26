<?php

use yii\db\Migration;

/**
 * Class m180605_010220_add_express_price_to_lx_sales_flat_order
 */
class m180605_010220_add_express_price_to_lx_sales_flat_order extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addColumn('{{%sales_flat_order}}', 'express_amount', $this->decimal(12,2)->defaultValue(NULL)->comment('快递金额'));
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        echo "m180605_010220_add_express_price_to_lx_sales_flat_order cannot be reverted.\n";
        $this>dropColumn('{{%sales_falt_order}}', 'express_amount');

        return false;
    }
}
