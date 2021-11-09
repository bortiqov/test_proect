<?php

namespace common\modules\user\forms;

use phpDocumentor\Reflection\DocBlock\Tags\Return_;
use Yii;
use yii\base\Model;
use common\components\FormModel;
use common\modules\user\models\User;
use common\modules\user\models\UserEmailConfirmation;

/**
 * Confirm form
 */
class ConfirmEmailForm extends Model
{
    use FormModel;

    /**
     * @var
     */
    public $email;

    /**
     * @var
     */
    public $code;

    /**
     * @var
     */
    private $_user;

    /**
     * @var
     */
    private $_email;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'code'], 'required'],
            [['code'], 'validateCode']
        ];
    }

    /**
     * @param $attribute
     * @param $params
     */
    public function validateCode($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if ($user && $user->status === User::STATUS_ACTIVE) {
                $this->setResponseCode(104);
                $this->addError($attribute, 'This user was already confirmed.');
            }

            if (!$user || !$this->getEmail()) {
                $this->setResponseCode(105);
                $this->addError($attribute, 'Confirmation code is not valid.');
                \Yii::$app->session->setFlash('login', __('Confirm code is expired!'));
            }
        }
    }

    /**
     * Finds user by [[email]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByEmail($this->email);
        }

        return $this->_user;
    }

    /**
     * Finds email by [[email, code]]
     *
     * @return UserEmailConfirmation|null
     */
    protected function getEmail()
    {
        if ($this->_email === null) {
            $this->_email = UserEmailConfirmation::validateConfirmation($this->email, $this->code);
        }

        return $this->_email;
    }

    /**
     * @return array|bool|User|null
     */
    public function save()
    {

        if (!$this->validate()) {
            return false;
        }

        $user = $this->getUser();

        $user->setActivated();

        $email = $this->getEmail();
        
        $email->setConfirmed();

        return $user;
    }
}
