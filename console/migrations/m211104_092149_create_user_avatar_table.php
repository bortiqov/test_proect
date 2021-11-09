<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_avatar}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%file}}`
 */
class m211104_092149_create_user_avatar_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_avatar}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'file_id' => $this->integer(),
            'sort' => $this->integer(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-user_avatar-user_id}}',
            '{{%user_avatar}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-user_avatar-user_id}}',
            '{{%user_avatar}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `file_id`
        $this->createIndex(
            '{{%idx-user_avatar-file_id}}',
            '{{%user_avatar}}',
            'file_id'
        );

        // add foreign key for table `{{%file}}`
        $this->addForeignKey(
            '{{%fk-user_avatar-file_id}}',
            '{{%user_avatar}}',
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
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-user_avatar-user_id}}',
            '{{%user_avatar}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-user_avatar-user_id}}',
            '{{%user_avatar}}'
        );

        // drops foreign key for table `{{%file}}`
        $this->dropForeignKey(
            '{{%fk-user_avatar-file_id}}',
            '{{%user_avatar}}'
        );

        // drops index for column `file_id`
        $this->dropIndex(
            '{{%idx-user_avatar-file_id}}',
            '{{%user_avatar}}'
        );

        $this->dropTable('{{%user_avatar}}');
    }
}
