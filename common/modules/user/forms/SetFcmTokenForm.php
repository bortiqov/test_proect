<?php

namespace common\modules\user\forms;

use Yii;
use yii\base\Model;
use common\modules\user\models\User;

/**
 * SetFcmTokenForm form
 */
class SetFcmTokenForm extends Model
{
    public $token;

    /**
     * @var
     */
    private $_user;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['token'], 'required'],
        ];
    }

    /**
     * @return array|bool|User|null
     */
    public function save()
    {
        if (!$this->validate()) {
            return false;
        }

        /**
         * @var $user User
         */
        $user = $this->getUser();
        $user->updateAttributes([
            'fcm_token' => $this->token
        ]);

        return $user;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findIdentity(Yii::$app->user->id);
        }

        return $this->_user;
    }
}
