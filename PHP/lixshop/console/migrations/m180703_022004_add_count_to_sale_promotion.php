<?php

use yii\db\Migration;

/**
 * Class m180703_022004_add_count_to_sale_promotion
 */
class m180703_022004_add_count_to_sale_promotion extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%sale_promotion}}', 'sale_count', $this->integer()->defaultValue(0)->comment('已经团购数量'));
        $this->addColumn('{{%sale_promotion}}', 'created_at', $this->timestamp());
        $this->addColumn('{{%sale_promotion}}', 'updated_at', $this->timestamp()->defaultValue(NULL));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180703_022004_add_count_to_sale_promotion cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180703_022004_add_count_to_sale_promotion cannot be reverted.\n";

        return false;
    }
    */
}
