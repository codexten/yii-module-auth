<?php

namespace codexten\yii\modules\auth\models\query;

use yii\db\ActiveQuery;

/**
 * Class UserTokenQuery
 *
 * @package codexten\yii\modules\auth\models\query
 */
class UserTokenQuery extends ActiveQuery
{
    /**
     * @return $this
     */
    public function notExpired()
    {
        $this->andWhere(['>', 'expire_at', time()]);

        return $this;
    }

    /**
     * @param $type
     *
     * @return $this
     */
    public function byType($type)
    {
        $this->andWhere(['type' => $type]);

        return $this;
    }

    /**
     * @param $token
     *
     * @return $this
     */
    public function byToken($token)
    {
        $this->andWhere(['code' => $token]);

        return $this;
    }


    /**
     * @param $type
     *
     * @return $this
     */
    public function byUserId($userId)
    {
        $this->andWhere(['user_id' => $userId]);

        return $this;
    }
}
