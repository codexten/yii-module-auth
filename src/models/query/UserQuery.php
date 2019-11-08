<?php

namespace codexten\yii\modules\auth\models\query;

class UserQuery extends \codexten\yii\user\models\query\UserQuery
{
    /**
     * @param null $db
     *
     * @return array|\codexten\yii\models\User[]
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @param null $db
     *
     * @return array|\codexten\yii\models\User|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
