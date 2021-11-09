<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%university_image}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%file}}`
 * - `{{%university}}`
 */
class m211030_182353_create_university_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%university_image}}', [
            'id' => $this->primaryKey(),
            'file_id' => $this->integer(),
            'university_id' => $this->integer(),
            'sort' => $this->integer(),
        ]);

        // creates index for column `file_id`
        $this->createIndex(
            '{{%idx-university_image-file_id}}',
            '{{%university_image}}',
            'file_id'
        );

        // add foreign key for table `{{%file}}`
        $this->addForeignKey(
            '{{%fk-university_image-file_id}}',
            '{{%university_image}}',
            'file_id',
            '{{%file}}',
            'id',
            'CASCADE'
        );

        // creates index for column `university_id`
        $this->createIndex(
            '{{%idx-university_image-university_id}}',
            '{{%university_image}}',
            'university_id'
        );

        // add foreign key for table `{{%university}}`
        $this->addForeignKey(
            '{{%fk-university_image-university_id}}',
            '{{%university_image}}',
            'university_id',
            '{{%university}}',
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
            '{{%fk-university_image-file_id}}',
            '{{%university_image}}'
        );

        // drops index for column `file_id`
        $this->dropIndex(
            '{{%idx-university_image-file_id}}',
            '{{%university_image}}'
        );

        // drops foreign key for table `{{%university}}`
        $this->dropForeignKey(
            '{{%fk-university_image-university_id}}',
            '{{%university_image}}'
        );

        // drops index for column `university_id`
        $this->dropIndex(
            '{{%idx-university_image-university_id}}',
            '{{%university_image}}'
        );

        $this->dropTable('{{%university_image}}');
    }
}
