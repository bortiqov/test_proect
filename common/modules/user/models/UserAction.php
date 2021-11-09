<?php

namespace common\modules\user\models;

use common\modules\exebition\models\Exebition;
use common\modules\organisation\models\Organisation;
use Yii;

/**
 * This is the model class for table "user_action".
 *
 * @property int $id
 * @property int|null $created_at
 * @property string|null $action
 * @property string|null $controller
 * @property string|null $uri
 * @property string|null $cookies
 * @property string|null $get_params
 * @property string|null $post_params
 * @property string|null $user_agent
 * @property string|null $referer
 * @property int|null $user_id
 * @property string|null $user_ip
 * @property int|null $exhibition_id
 */
class UserAction extends \yii\db\ActiveRecord
{

    public $activities;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_action';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'user_id'], 'default', 'value' => null],
            [['created_at', 'user_id', 'exhibition_id', 'activities'], 'integer'],
            [['cookies', 'get_params', 'post_params'], 'safe'],
            [['action', 'controller', 'user_agent', 'referer', 'user_ip'], 'string', 'max' => 255],
            [['uri'], 'string', 'max' => 512],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'action' => 'Action',
            'controller' => 'Controller',
            'uri' => 'Uri',
            'cookies' => 'Cookies',
            'get_params' => 'Get Params',
            'post_params' => 'Post Params',
            'user_agent' => 'User Agent',
            'referer' => 'Referer',
            'user_id' => 'User ID',
            'user_ip' => 'User Ip',
        ];
    }

    /**
     * {@inheritdoc}
     * @return UserActionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserActionQuery(get_called_class());
    }

    public function getUser() {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getExhibition() {
        return $this->hasOne(Exebition::class, ['id' => 'exhibition_id']);
    }

    public function getOrganization($organizationId) {
        return Organisation::find()->where(['id' => $organizationId ? $organizationId : $this->get_params['organization_id']]);
    }

    public static function getActivities($exhibitionId, $organizationId) {
        return static::find()->where('exhibition_id = ' . $exhibitionId . ' AND get_params->>\'organization_id\' = \'' . $organizationId . "'");
    }

    public function getActivitiesByUser($exhibitionId, $userId) {
        return static::find()->where(['exhibition_id' => $exhibitionId, 'user_id' => $userId]);
    }

}
