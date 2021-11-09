<?php

namespace common\modules\language\models;

use common\modules\language\models\query\LanguageQuery;
use Yii;

/**
 * This is the model class for table "language".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $code
 * @property int|null $status
 */
class Language extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'language';
    }

    /**
     * {@inheritdoc}
     * @return LanguageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LanguageQuery(get_called_class());
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'default', 'value' => null],
            [['status'], 'integer'],
            [['name', 'code'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'code' => 'Code',
            'status' => 'Status',
        ];
    }

    public function isActive()
    {
        return \Yii::$app->language == $this->code;
    }
}
