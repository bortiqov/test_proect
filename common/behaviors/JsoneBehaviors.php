<?php

namespace common\behaviors;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Json;

class JsoneBehaviors extends \yii\behaviors\AttributeBehavior
{
    /**
     * @var
     */
    public $attribute;
    /**
     * @var string
     */
    public $disableScenarios = [];
    /**
     * @var null
     */
    public $old_value = null;
    /**
     * @var null
     */
    public $default = null;

    /**
     * @return array
     */
    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_FIND => 'decode',
            ActiveRecord::EVENT_BEFORE_INSERT => 'encode',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'encode',
        ];
    }

    /**
     * @return mixed
     */
    public function decode()
    {
            $this->owner->{$this->attribute} = Json::decode($this->owner->{$this->attribute});
    }

    /**
     * @return mixed|void
     */
    public function encode()
    {
        $this->owner->{$this->attribute} = Json::encode($this->owner->{$this->attribute});
    }

}