<?php

namespace common\models;

use common\modules\file\models\File;
use phpDocumentor\Reflection\Types\Array_;
use phpDocumentor\Reflection\Types\String_;
use Yii;

/**
 * This is the model class for table "banner".
 *
 * @property int $id
 * @property string|null $title
 * @property int|null $file_id
 * @property int|null $status
 * @property int|null $type
 *
 * @property File $file
 */
class Banner extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;


    const TYPE_MAIN = 1;
    const TYPE_BLOG = 2;
    const TYPE_FILIAL = 3;
    const TYPE_UNIVERSITY = 4;
    const TYPE_GALLERY = 5;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'banner';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'safe'],
            [['title','file_id','type'], 'required'],
            [['file_id', 'status'], 'default', 'value' => null],
            [['file_id', 'status','type'], 'integer'],
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
            'title' => 'Title',
            'file_id' => 'File ID',
            'status' => 'Status',
        ];
    }

    public static function getTypes()
    {
        return [
            self::TYPE_MAIN => 'Main',
            self::TYPE_BLOG => 'Blog',
            self::TYPE_FILIAL => 'Filial',
            self::TYPE_UNIVERSITY => 'University',
            self::TYPE_GALLERY => 'Gallery'
        ];
    }

    /**
     * @return String
     */
    public function getType()
    {
        return self::getTypes()[$this->type];
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
}
