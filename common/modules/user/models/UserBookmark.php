<?php

namespace common\modules\user\models;

use common\modules\organization\behaviors\EventBehavior;
use common\modules\organization\models\Organization;
use common\modules\organization\models\OrganizationEvent;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "user_bookmark".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $organization_id
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $status
 *
 * @property Organization $organization
 * @property User $user
 */
class UserBookmark extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_bookmark';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'organization_id', 'created_at', 'updated_at', 'status'], 'default', 'value' => null],
            [['user_id', 'organization_id', 'created_at', 'updated_at', 'status'], 'integer'],
            [['organization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['organization_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            'event_handler' => [
                'class' => EventBehavior::class,
                'type' => OrganizationEvent::TYPE_BOOKMARKED,
                'organizationAttribute' => 'organization_id'
            ],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'organization_id' => 'Organization ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Organization]].
     *
     * @return \yii\db\ActiveQuery|\common\modules\user\models\OrganizationQuery
     */
    public function getOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'organization_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|\common\modules\user\models\UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\user\models\UserBookmarkQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserBookmarkQuery(get_called_class());
    }
}
