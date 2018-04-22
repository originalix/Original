<?php

use yii\db\Migration;

/**
 * Class m180422_113443_add_category_table_column
 */
class m180422_113443_add_category_table_column extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('{{%category}}', 'icon', $this->string(255)->after('category'));
    }

    public function down()
    {
        echo "m180422_113443_add_category_table_column cannot be reverted.\n";

        return false;
    }
}
