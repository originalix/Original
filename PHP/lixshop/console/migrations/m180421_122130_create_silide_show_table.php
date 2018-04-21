<?php

use yii\db\Migration;

/**
 * Handles the creation of table `silide_show`.
 */
class m180421_122130_create_silide_show_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('silide_show', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('silide_show');
    }
}
