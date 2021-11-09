<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "phone".
 *
 * @property int $id
 * @property string|null $phone
 * @property int|null $created_at
 */
class Phone extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'phone';
    }

    public function behaviors()
    {
        return [
            'created_at' => [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => 'created_at'
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at'], 'default', 'value' => null],
            [['created_at'], 'integer'],
            [['phone'], 'string', 'max' => 255],
            [['phone'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'phone' => 'Phone',
            'created_at' => 'Created At',
        ];
    }
}
