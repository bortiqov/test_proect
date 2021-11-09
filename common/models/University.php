<?php

namespace common\models;

use common\behaviors\SlugBehavior;
use common\modules\file\behaviors\FileModelBehavior;
use common\modules\file\behaviors\InputModelBehavior;
use common\modules\file\models\File;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "university".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $address
 * @property string|null $name
 * @property string|null $description
 * @property string|null $slug
 * @property string|null $photo
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $top
 * @property int|null $viewed
 * @property int|null $status
 * @property int|null $short_link
 *
 * @property UniversityImage[] $universityImages
 */
class University extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1 ;
    const STATUS_INACTIVE = 0 ;
    /**
     * {@inheritdoc}
     */
    private $_filesdata;

    public static function tableName()
    {
        return 'university';
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'date_filter' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
            'file_manager' => [
                'class' => FileModelBehavior::className(),
                'attribute' => 'filesdata',
                'relation_name' => 'files',
                'delimitr' => ',',
                'via_table_name' => 'university_image',
                'via_table_relation' => 'universityImages',
                'one_table_column' => 'university_id',
                'two_table_column' => 'file_id'
            ],
            'input_filemanager' => [
                'class' => InputModelBehavior::className(),
            ],
            'added_slug' => [
                'class' => SlugBehavior::class,
                'attribute_title' => 'name'

            ]
        ]);
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'name', 'description','filesdata','address'], 'safe'],
            [['title', 'name', 'description','photo','address'], 'required'],
            [['created_at', 'updated_at', 'top', 'viewed', 'status', 'short_link'], 'default', 'value' => null],
            [['created_at', 'updated_at', 'top', 'viewed', 'status', 'short_link'], 'integer'],
            [['slug', 'photo'], 'string', 'max' => 255],
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
            'name' => 'Name',
            'description' => 'Description',
            'slug' => 'Slug',
            'photo' => 'Photo',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'top' => 'Top',
            'viewed' => 'Viewed',
            'status' => 'Status',
            'short_link' => 'Short Link',
        ];
    }

    /**
     * Gets query for [[UniversityImages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUniversityImages()
    {
        return $this->hasMany(UniversityImage::className(), ['university_id' => 'id']);
    }

    public function getFiles()
    {
        return $this->hasMany(File::className(), ['id' => 'file_id'])->via('universityImages');
    }

    public function getPicture()
    {
        return $this->hasOne(File::className(), ['id' => 'photo']);
    }

    public function getFilesdata()
    {
        return $this->_filesdata;
    }
    public function setFilesdata($value)
    {
        return $this->_filesdata = $value;
    }

    public function getPrettyName()
    {
        return $this->name[Yii::$app->language];
    }
    public function getPrettyTitle()
    {
        return $this->title[Yii::$app->language];
    }

    public function getPrettyAddress()
    {
        return $this->address[Yii::$app->language];
    }

    public function getPrettyDescription()
    {
        return $this->description[Yii::$app->language];
    }
}
