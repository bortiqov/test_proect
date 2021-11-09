<?php

namespace common\modules\user\models;

/**
 * This is the ActiveQuery class for [[UserAction]].
 *
 * @see UserAction
 */
class UserActionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return UserAction[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UserAction|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
