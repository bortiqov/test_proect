<?php

namespace common\components;

class ActiveRecord extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = null;

    public function delete()
    {
        $this->updateAttributes(['status' => static::STATUS_INACTIVE]);
    }
}
