<?php

namespace common\modules\menu\migrations;

use yii\db\Migration;

/**
 * Class m180813_082103_create_table_menu_items
 */
class MenuItems extends Migration
{
    private $tableName = '{{%menu_items}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tableName, [
            'menu_item_id' => $this->primaryKey(),
            'menu_id' => $this->integer(),
            'title' => 'json',
            'url' => $this->string(),
            'sort' => $this->integer(),
            'menu_item_parent_id' => $this->integer(),
            'icon' => $this->string(255)
        ], $tableOptions);


        $this->batchInsert($this->tableName, ['menu_id', 'title', 'url', 'icon'], [
            ['1', ["en" => "User", "ru" => "User", "uz" => "User"], '/user/user', 'fa fa-user'],
            ['1', ["en" => "Zone", "ru" => "Zone", "uz" => "Zone"], '/zone/zone', 'fa fa-bars'],
            ['1', ["en" => "Space", "ru" => "Space", "uz" => "Space"], '/space/space', 'fa fa-bars'],
            ['1', ["en" => "Post", "ru" => "Post", "uz" => "Post"], '/post/post', 'fa fa-bars'],
            ['1', ["en" => "Order", "ru" => "Order", "uz" => "Order"], '/order/order', 'fa fa-bars'],
            ['1', ["en" => "Transaction", "ru" => "Transaction", "uz" => "Transaction"], '/transaction/transaction', 'fa fa-bars'],
            ['1', ["en" => "Menu", "ru" => "Menu", "uz" => "Menu"], '/menu/menu', 'fa fa-bars'],
            ['1', ["en" => "Category", "ru" => "Category", "uz" => "Category"], '/category/category', 'fa fa-bars'],
        ]);
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
