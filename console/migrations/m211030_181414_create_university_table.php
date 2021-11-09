<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%university}}`.
 */
class m211030_181414_create_university_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $options = null;
        if ($this->getDb()->getDriverName() == 'mysql') {
            $options = "character set utf8 collate utf8_general_ci engine=InnoDB";
        }

        $this->createTable('university', [
            'id' => $this->primaryKey(),
            'title' => 'json',
            'name' => 'json',
            'description' => 'json',
            'address' => 'json',
            'slug' => $this->string(),
            'photo' => $this->string(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'top' => $this->integer(),
            'viewed' => $this->integer(),
            'status' => $this->integer(),
            'short_link' => $this->integer(8)
        ], $options);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('university');
    }
}
