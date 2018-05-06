<?php

use yii\db\Migration;

/**
 * Handles the creation of table `silide_show`.
 */
class m180421_122130_create_silide_show_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%slide_show}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->defaultValue(null)->comment('轮播图标题'),
            'path' => $this->string(255)->defaultValue(null)->comment('存储路径'),
            'filename' => $this->string(255)->defaultValue(null)->comment('文件名'),
            'is_usage' => $this->boolean()->comment('是否使用'),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultValue(null)
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%slide_show}}');
    }
}
