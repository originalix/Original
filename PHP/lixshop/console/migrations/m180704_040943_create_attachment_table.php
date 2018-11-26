<?php

use yii\db\Migration;

/**
 * Handles the creation of table `attachment`.
 */
class m180704_040943_create_attachment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%attachment}}', [
            'id' => $this->primaryKey(),
            'type' => $this->string()->defaultValue('default')->comment('图片使用类型'),
            'type_id' => $this->integer()->defaultValue(NULL)->comment('关联模型id'),
            'path' => $this->string()->defaultValue(NULL)->comment('图片存储路径'),
            'url' => $this->string()->defaultValue(NULL)->comment('展示url'),
            'width' => $this->integer()->defaultValue(NULL)->comment('图片的宽'),
            'height' => $this->integer()->defaultValue(NULL)->comment('高'),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultValue(null)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%attachment}}');
    }
}
