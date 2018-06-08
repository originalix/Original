<?php

use yii\db\Migration;

/**
 * Class m180608_011832_add_express_type_to_sales_flat_order
 */
class m180608_011832_add_express_type_to_sales_flat_order extends Migration
{
    public function up()
    {
        $this->addColumn('{{%sales_flat_order}}', 'express_type', $this->integer(2)->defaultValue(0)->comment('配送方式，0上门配送,1到店取送'));
        $this->addColumn('{{%sales_flat_order}}', 'express_date', $this->string(32)->defaultValue(NULL)->comment('配送日期'));
        $this->addColumn('{{%sales_flat_order}}', 'express_time', $this->string(32)->defaultValue(NULL)->comment('配送时段'));
    }

    public function down()
    {
        echo "m180608_011832_add_express_type_to_sales_flat_order cannot be reverted.\n";

        return false;
    }
}

