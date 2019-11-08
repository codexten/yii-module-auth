<?php

namespace codexten\yii\modules\auth\models\query;

use \yii\db\ActiveQuery;
use \codexten\yii\modules\auth\models\UserProfile;

/**
 * This is the ActiveQuery class for [[\codexten\yii\modules\auth\models\UserProfile]].
 *
 * @see UserProfile
 */
class UserProfileQuery extends ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return UserProfile[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UserProfile|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
