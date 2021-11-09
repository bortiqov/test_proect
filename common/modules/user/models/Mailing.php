<?php

namespace common\modules\user\models;

use Yii;

/**
 * This is the model class for table "mailing".
 *
 * @property int $id
 * @property string|null $email
 * @property string|null $subject
 * @property string|null $message
 * @property int|null $status
 */
class Mailing extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mailing';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subject', 'message'], 'string'],
            [['status'], 'default', 'value' => null],
            [['status'], 'integer'],
            [['email'], 'string', 'max' => 255],
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
            'subject' => 'Subject',
            'message' => 'Message',
            'status' => 'Status',
        ];
    }

    /**
     * {@inheritdoc}
     * @return MailingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MailingQuery(get_called_class());
    }
}
