<?php

namespace common\modules\user\models;


use common\models\UserAvatar;
use common\modules\file\behaviors\FileModelBehavior;
use common\modules\file\behaviors\InputModelBehavior;
use common\modules\file\models\File;

use common\modules\zone\models\Order;
use Yii;
use yii\base\ErrorException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $password_hash
 * @property string $email
 * @property string $phone
 * @property string $auth_key
 * @property string $website
 * @property string $contact_number
 * @property string $company_name
 * @property string $job_title
 * @property integer $status
 * @property integer $image_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $affiliate_key
 * @property string $password write-only password
 * @property string $fcm_token [varchar(255)]
 * @property string $password_reset_token [varchar(255)]
 * @property string $verification_token [varchar(255)]
 * @property int $type [smallint]
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     *
     */
    const STATUS_DELETED = 0;

    /**
     *
     */
    const STATUS_INACTIVE = 9;

    /**
     *
     */
    const STATUS_ACTIVE = 10;

    const ROLE_EDITOR = 1;

    const ROLE_ADMIN = 10;
    const ROLE_USER = 9;


    /**
     * @var
     */
    public $password;

    private $_filesdata;
    /**
     * @var
     */
    public $password_confirm;

    /**
     * @var $role
     */

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['token' => $token, 'status' => self::STATUS_ACTIVE]);
    }

    public function getFullName()
    {
        return $this->first_name ." " .$this->last_name;
    }

    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */

    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    /**
     *
     */
    public static function isEmailExists($email, $id = null)
    {
        return static::find()->where(['email' => $email])->andWhere(['<>', 'id', $id])->exists();
    }

    /**
     *
     */
    public static function isPhoneExists($phone)
    {
        return static::find()->where(['phone' => $phone])->exists();
    }

    public static function getUserRole($user_id)
    {
        return ArrayHelper::map(Yii::$app->authManager->getRolesByUser($user_id), 'name', 'name');
    }


    public static function findByEAuth($service)
    {
        if (!$service->getIsAuthenticated()) {
            throw new ErrorException('EAuth user should be authenticated before creating identity.');
        } else {
            $hasAlready = static::findOne(['email' => $service->getAttribute('email')]);
            if (!isset($hasAlready)) {
                $newUser = new User();
                $newUser->first_name = $service->getAttribute('first_name');
                $newUser->last_name = $service->getAttribute('last_name');
                $newUser->email = $service->getAttribute('email');
                $newUser->interested_area = 'Expo';
                $newUser->setPassword(md5('qw1234er5678ty'));
                $newUser->status = self::STATUS_ACTIVE;

//                if($newUser->save())
                $newUser->save();
                return $newUser;
            }
            return $hasAlready;
        }
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int)substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    public static function getDropdownList()
    {
        return ArrayHelper::map(static::find()->all(), 'id', 'email');
    }


    public static function getRoles()
    {
        return ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'name');
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'file_manager' => [
                'class' => FileModelBehavior::className(),
                'attribute' => 'filesdata',
                'relation_name' => 'avatar',
                'delimitr' => ',',
                'via_table_name' => 'user_avatar',
                'via_table_relation' => 'userAvatar',
                'one_table_column' => 'user_id',
                'two_table_column' => 'file_id'
            ],
            TimestampBehavior::className(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email'], 'email'],
            [['first_name', 'last_name', 'email', 'password_reset_token'], 'string'],
            [['first_name', 'last_name', 'email'], 'required'],
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            [['password'], 'string', 'min' => 6],
            [['filesdata'], 'safe'],
            [['filesdata'], 'required','message' => 'Photo yuklashni unitdingiz'],
            [['password_confirm'], 'compare', 'compareAttribute' => 'password'],
            [['role'], 'integer'],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'status' => 'Статус',
            'type' => 'Тип',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * @throws \yii\base\Exception
     */
    public function setToken()
    {
        $this->token = self::generateToken();
    }

    /**
     * @return string
     * @throws \yii\base\Exception
     */
    public static function generateToken()
    {
        return \Yii::$app->security->generateRandomString(64);
    }

    /**
     * @return array|UserEmailConfirmation|ActiveRecord|null
     */
    public function sendEmailConfirmationCode()
    {
        $confirmation = UserEmailConfirmation::find()
            ->where(['email' => $this->email, 'status' => UserEmailConfirmation::STATUS_UNCONFIRMED])
            ->andWhere(['>', 'expires_at', time()])
            ->one();

        if (!($confirmation instanceof UserEmailConfirmation)) {

            UserEmailConfirmation::updateAll(['status' => UserEmailConfirmation::STATUS_DELETED], ['email' => $this->email]);

            $confirmation = new UserEmailConfirmation();
            $confirmation->setCodeLength(6);
            $confirmation->setAttributes([
                'user_id' => $this->id,
                'email' => $this->email
            ]);

            if ($confirmation->save()) {
                Yii::$app->mailer->compose()
                    ->setFrom(getenv('MAILER_USERNAME'))
                    ->setTo($this->email)
                    ->setSubject('Email Confirmation Subject')
                    ->setHtmlBody('You successfully registred on funzone.uz. Please confirm your email: ' . '<a href="http://api.funzone.loc/v1/user/confirm-email?email=' . $this->email . '&code=' . $confirmation->code . '">Activate</a> <br> <h1>' . $confirmation->code . ' </h1>')
                    ->send();
                $confirmation->updateAttributes(['status' => UserEmailConfirmation::STATUS_SENT]);
            }
        }

        return $confirmation;
    }

    /**
     * @return array|UserEmailConfirmation|ActiveRecord|null
     */
    public function sendEmailForgotPasswordConfirmationCode()
    {
        $confirmation = UserEmailConfirmation::find()
            ->where(['email' => $this->email, 'status' => UserEmailConfirmation::STATUS_UNCONFIRMED])
            ->andWhere(['>', 'expires_at', time()])
            ->one();

        if (!($confirmation instanceof UserEmailConfirmation)) {

            UserEmailConfirmation::updateAll(['status' => UserEmailConfirmation::STATUS_DELETED], ['email' => $this->email]);

            $confirmation = new UserEmailConfirmation();
            $confirmation->setCodeLength(10);
            $confirmation->setAttributes([
                'user_id' => $this->id,
                'email' => $this->email
            ]);

            if ($confirmation->save()) {
                Yii::$app->mailer->compose()
                    ->setFrom(getenv('MAILER_USERNAME'))
                    ->setTo($this->email)
                    ->setSubject('Email Confirmation Subject')
                    ->setHtmlBody('You successfully registred on funzone.uz. Please confirm your email: ' . '<a href="http://api.funzone.loc/v1/user/forgot-email?email=' . $this->email . '&code=' . $confirmation->code . '">Restore Password</a> <br> <h1>' . $confirmation->code . ' </h1>')
                    ->send();
                $confirmation->updateAttributes(['status' => UserEmailConfirmation::STATUS_SENT]);
            }
        }

        return $confirmation;

    }

    public function generatePasswordResetToken()
    {

        $this->password_reset_token = Yii::$app->security->generateRandomString(16) . '_' . time();
    }

    /**
     * @return int
     */
    public function setActivated()
    {
        return $this->updateAttributes([
            'status' => static::STATUS_ACTIVE
        ]);
    }

    /**
     * @return int
     * @throws \yii\base\Exception
     */
    public function updateToken()
    {
        return $this->updateAttributes([
            'token' => self::generateToken()
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImageThumbs()
    {
        $image = $this->image;

        if (!$image) {
            return null;
        }

        return @$image->getImageThumbs();
    }

    public function getUserAvatar()
    {
        return $this->hasOne(UserAvatar::class, ['user_id' => 'id']);
    }

    /**
     * @return File|\yii\db\ActiveQuery|null
     */

    public function getAvatar()
    {
        return $this->hasOne(File::class, ['id' => 'file_id'])->via('userAvatar');
    }


    /**
     * @return array|false
     */
    public function fields()
    {
        return [
            "id",
            "email",
            "token",
            "first_name",
            "last_name",
            "image" => function ($model) {
                $image = $model->avatar ?? null;

                if (!$image) {
                    return null;
                }

                return @$image->getImageSrc('small');
            },
            "created_at",
            "updated_at",
            "status",
            "role"

        ];
    }

    public function extraFields()
    {
        return [
            'order' => function () {
                return $this->getOrder();
            },
        ];
    }

    public function getOrder()
    {
        return $this->hasMany(Order::class, ['user_id' => 'id']);
    }


    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getFilesdata()
    {
        return $this->_filesdata;
    }

    public function setFilesdata($value)
    {
        return $this->_filesdata = $value;
    }
}
