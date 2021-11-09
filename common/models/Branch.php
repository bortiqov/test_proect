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
 * This is the model class for table "branch".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $address
 * @property string|null $phone
 * @property int|null $file_id
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property File $file
 */
class Branch extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'branch';
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
            'input_filemanager' => [
                'class' => InputModelBehavior::className(),
            ],

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['address'], 'safe'],
            [['address'], 'required'],
            [['file_id','title', 'status', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['file_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['phone'], 'string', 'max' => 255],
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
            'address' => 'Address',
            'phone' => 'Phone',
            'file_id' => 'File ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
}
