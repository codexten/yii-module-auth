<?php

namespace codexten\yii\modules\auth\models\query;


use codexten\yii\modules\auth\models\Account;
use yii\authclient\ClientInterface;
use yii\db\ActiveQuery;

/**
 * @method Account|null one($db = null)
 * @method Account[]    all($db = null)
 *
 * @author Jomon Johnson <cto@codexten.com>
 */
class AccountQuery extends ActiveQuery
{
    /**
     * Finds an account by code.
     *
     * @param  string $code
     *
     * @return AccountQuery
     */
    public function byCode($code)
    {
        return $this->andWhere(['code' => md5($code)]);
    }

    /**
     * Finds an account by id.
     *
     * @param  integer $id
     *
     * @return AccountQuery
     */
    public function byId($id)
    {
        return $this->andWhere(['id' => $id]);
    }

    /**
     * Finds an account by user_id.
     *
     * @param  integer $userId
     *
     * @return AccountQuery
     */
    public function byUser($userId)
    {
        return $this->andWhere(['user_id' => $userId]);
    }

    /**
     * Finds an account by client.
     *
     * @param  ClientInterface $client
     *
     * @return AccountQuery
     */
    public function byClient(ClientInterface $client)
    {
        return $this->andWhere([
            'provider' => $client->getId(),
            'client_id' => $client->getUserAttributes()['id'],
        ]);
    }
}
