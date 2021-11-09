<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%gallery}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%file}}`
 */
class m211104_090615_create_gallery_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%gallery}}', [
            'id' => $this->primaryKey(),
            'file_id' => $this->integer(),
            'status' => $this->integer(),
            'sort' => $this->integer(),
        ]);

        // creates index for column `file_id`
        $this->createIndex(
            '{{%idx-gallery-file_id}}',
            '{{%gallery}}',
            'file_id'
        );

        // add foreign key for table `{{%file}}`
        $this->addForeignKey(
            '{{%fk-gallery-file_id}}',
            '{{%gallery}}',
            'file_id',
            '{{%file}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%file}}`
        $this->dropForeignKey(
            '{{%fk-gallery-file_id}}',
            '{{%gallery}}'
        );

        // drops index for column `file_id`
        $this->dropIndex(
            '{{%idx-gallery-file_id}}',
            '{{%gallery}}'
        );

        $this->dropTable('{{%gallery}}');
    }
}
