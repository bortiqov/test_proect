<?php

namespace common\modules\user\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "subscribe".
 *
 * @property int $id
 * @property string $email
 * @property int $created_at
 */
class Subscribe extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subscribe';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            [['created_at'], 'integer'],
            [['email'], 'string', 'max' => 255],
            [['email'], 'email'],
            [['email'], 'unique']
        ];
    }


    public function behaviors()
    {
        return [
            'date_filter' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'created_at' => 'Created At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return SubscribeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SubscribeQuery(get_called_class());
    }

    public function fields()
    {
        return ['id', 'email', 'created_at'];
    }
}
