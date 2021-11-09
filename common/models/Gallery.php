<?php

namespace common\models;

use common\modules\file\models\File;
use Yii;

/**
 * This is the model class for table "gallery".
 *
 * @property int $id
 * @property int|null $file_id
 * @property int|null $status
 * @property int|null $sort
 *
 * @property File $file
 */
class Gallery extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gallery';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['file_id', 'status', 'sort'], 'default', 'value' => null],
            [['file_id', 'status', 'sort'], 'integer'],
            [['file_id'], 'required'],
            [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => File::className(), 'targetAttribute' => ['file_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'file_id' => 'File ID',
            'status' => 'Status',
            'sort' => 'Sort',
        ];
    }

    /**
     * Gets query for [[File]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(File::className(), ['id' => 'file_id']);
    }

    public function getPicture()
    {
        return $this->hasOne(File::class,['id' => 'file_id']);
    }
}
