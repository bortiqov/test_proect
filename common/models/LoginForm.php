<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $email;
    public $password;
    public $rememberMe = true;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // email and password are both required
            [['email', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect email or password.');
            }
        }
    }

    /**
     * Finds user by [[email]]
     *
     * @return \common\modules\user\models\User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = \common\modules\user\models\User::findByEmail($this->email);
        }

        return $this->isActive();
    }

    /**
     * Checked user by [[status]]
     *
     * @return \common\modules\user\models\User|null
     */

    protected function isActive()
    {
        if ($this->_user && $this->_user->status === \common\modules\user\models\User::STATUS_ACTIVE){
            return $this->_user;
        }
        return  null;
    }
    /**
     * Logs in a user using the provided email and password.
     *
     * @return $model whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            $user = $this->getUser();
            $user->updateToken();
            Yii::$app->user->login($user, $this->rememberMe ? 3600 * 24 * 30 : 0);

            return $user;

        }

        return false;
    }
}
