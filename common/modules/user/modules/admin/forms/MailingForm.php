<?php

namespace common\modules\user\modules\admin\forms;

use common\modules\file\models\File;
use Yii;
use yii\base\Model;
use common\components\FormModel;
use common\modules\user\models\User;
use common\modules\user\models\UserEmailConfirmation;

/**
 * Mailing form
 */
class MailingForm extends Model
{

    const TYPE_ALL = 1;
    const TYPLE_PER = 2;

    /**
     * @var
     */
    public $type;

    /**
     * @var
     */
    public $email;

    /**
     * @var
     */
    public $subject;

    /**
     * @var
     */
    public $message;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'subject', 'message'], 'required'],
            [['email'], 'email'],
        ];
    }


    /**
     * @return bool|User
     * @throws \yii\base\Exception
     */
    public function save()
    {
        if (!$this->validate()) {
            return  false;
        }

        $mails = [];

        if ($this->type == self::TYPE_ALL) {
            $users = User::find()->all();

            foreach ($users as $user) {
                $mails[] = [
                    'email' => $user->email,
                    'subject' => $this->subject,
                    'message' => $this->message
                ];
            }

        } else {
            $mails[] = [
                'email' => $this->email,
                'subject' => $this->subject,
                'message' => $this->message
            ];
        }

        $result = \Yii::$app->db->createCommand()->batchInsert("mailing", ['email', 'subject', 'message'], $mails)->execute();

        return $result;
    }
}
