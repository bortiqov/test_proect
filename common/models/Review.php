<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "review".
 *
 * @property int $id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property int|null $status
 * @property int|null $created_at
 * @property string|null $message
 */
class Review extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'review';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'created_at'], 'default', 'value' => null],
            [['status', 'created_at'], 'integer'],
            [['message'], 'string'],
            [['first_name', 'last_name'], 'string', 'max' => 255],
            [['first_name','last_name','message'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'status' => 'Status',
            'created_at' => 'Created At',
            'message' => 'Message',
        ];
    }


    public function getFullName()
    {
        return $this->first_name . " " .$this->last_name;
    }
}
