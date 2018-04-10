<?php

use yii\db\Migration;

/**
 * Class m180410_071034_create_admin_user
 */
class m180410_071034_create_admin_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180410_071034_create_admin_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180410_071034_create_admin_user cannot be reverted.\n";

        return false;
    }
    */
}
