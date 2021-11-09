<?php

namespace common\modules\user\forms;

use Yii;
use yii\base\Arrayable;
use yii\base\Model;
use common\modules\user\models\User;
use jakharbek\filemanager\dto\FileSaveDTO;
use jakharbek\filemanager\dto\FileUploadDTO;
use jakharbek\filemanager\helpers\FileManagerHelper;
use jakharbek\filemanager\services\FileService;

/**
 * UploadImageForm form
 */
class UploadImageForm extends Model
{
    /**
     * @var array
     */
    public $extensions = ['jpg', 'jpeg', 'png'];

    /**
     * @var
     */
    public $image;

    /**
     * @var
     */
    private $_user;

    /**
     * @var
     */
    private $_image;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['image', 'file', 'skipOnEmpty' => false, 'maxFiles' => 2, 'extensions' => $this->extensions],
        ];
    }

    /**
     * @return $this|array|bool|null
     * @throws \jakharbek\filemanager\exceptions\FileException
     */
    public function save()
    {
        if (!$this->validate()) {
            return false;
        }

        $dto = new FileUploadDTO();
        $dto->files = $this->image;
        $dto->useFileName = FileManagerHelper::useFileName();

        $service = new FileService();
        $fileUploadedDTO = $service->upload($dto);

        $fileSaveDTO = new FileSaveDTO();
        $fileSaveDTO->domain = getenv('STATIC_URL');

        $files = $service->save($fileUploadedDTO, $fileSaveDTO);

        if (!$files) {
            return $files;
        }

        $user = $this->getUser();

        $user->updateAttributes([
            'image_id' => @reset($files)->id
        ]);

        return $this->getUserImage();
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

    /**
     * @return mixed
     */
    private function getUserImage()
    {
        $user = $this->getUser();
        $userImage = $user->image;

        if(!$userImage){
            return null;
        }

        return $userImage;
    }

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'image' => function($model){
                return $model->getUserImage();
            }
        ];
    }
}
