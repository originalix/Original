<?php

use yii\db\Migration;

/**
 * Class m180730_014212_add_share_count_to_promotion
 */
class m180730_014212_add_share_count_to_promotion extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%sale_promotion}}', 'share_count', $this->integer()->defaultValue(0)->comment('需要分享数量'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180730_014212_add_share_count_to_promotion cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180730_014212_add_share_count_to_promotion cannot be reverted.\n";

        return false;
    }
    */
}
