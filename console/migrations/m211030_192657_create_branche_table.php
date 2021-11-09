<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%branche}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%file}}`
 */
class m211030_192657_create_branche_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%branch}}', [
            'id' => $this->primaryKey(),
            'title' => 'json',
            'address' => 'json',
            'phone' => $this->string(),
            'file_id' => $this->integer(),
            'status' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        // creates index for column `file_id`
        $this->createIndex(
            '{{%idx-branch-file_id}}',
            '{{%branch}}',
            'file_id'
        );

        // add foreign key for table `{{%file}}`
        $this->addForeignKey(
            '{{%fk-branch-file_id}}',
            '{{%branch}}',
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
            '{{%fk-branch-file_id}}',
            '{{%branch}}'
        );

        // drops index for column `file_id`
        $this->dropIndex(
            '{{%idx-branch-file_id}}',
            '{{%branch}}'
        );

        $this->dropTable('{{%branch}}');
    }
}
