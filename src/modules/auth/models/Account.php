<?php

namespace codexten\yii\modules\auth\models;

use codexten\yii\modules\auth\clients\ClientInterface;
use codexten\yii\modules\auth\Finder;
use codexten\yii\modules\auth\models\query\AccountQuery;
use codexten\yii\modules\auth\traits\ModuleTrait;
use Yii;
use yii\authclient\ClientInterface as BaseClientInterface;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;
use yii\helpers\Json;
use yii\helpers\Url;

/**
 * @property integer $id          Id
 * @property integer $user_id     User id, null if account is not bind to user
 * @property string $provider    Name of service
 * @property string $client_id   Account id
 * @property string $data        Account properties returned by social network (json encoded)
 * @property string $decodedData Json-decoded properties
 * @property string $code
 * @property integer $created_at
 * @property string $email
 * @property string $username
 *
 * @property User $user        User that this account is connected for.
 *
 * @author Jomon Johnson <cto@codexten.com>
 */
class Account extends ActiveRecord
{
    use ModuleTrait;

    /** @var Finder */
    protected static $finder;

    /** @var */
    private $_data;

    /** @inheritdoc */
    public static function tableName()
    {
        return '{{%social_account}}';
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->hasOne($this->module->modelMap['User'], ['id' => 'user_id']);
    }

    /**
     * @return bool Whether this social account is connected to user.
     */
    public function getIsConnected()
    {
        return $this->user_id != null;
    }

    /**
     * @return mixed Json decoded properties.
     */
    public function getDecodedData()
    {
        if ($this->_data == null) {
            $this->_data = Json::decode($this->data);
        }

        return $this->_data;
    }

    /**
     * Returns connect url.
     *
     * @return string
     */
    public function getConnectUrl()
    {
        $code = Yii::$app->security->generateRandomString();
        $this->updateAttributes(['code' => md5($code)]);

        return Url::to(['/user/registration/connect', 'code' => $code]);
    }

    public function connect(User $user)
    {
        return $this->updateAttributes([
            'username' => null,
            'email' => null,
            'code' => null,
            'user_id' => $user->id,
        ]);
    }

    /**
     * @return AccountQuery
     */
    public static function find()
    {
        return Yii::createObject(AccountQuery::className(), [get_called_class()]);
    }

    public static function create(BaseClientInterface $client)
    {
        /** @var Account $account */
        $account = Yii::createObject([
            'class' => static::className(),
            'provider' => $client->getId(),
            'client_id' => $client->getUserAttributes()['id'],
            'data' => Json::encode($client->getUserAttributes()),
        ]);

        if ($client instanceof ClientInterface) {
            $account->setAttributes([
                'username' => $client->getUsername(),
                'email' => $client->getEmail(),
            ], false);
        }

        if (($user = static::fetchUser($account)) instanceof User) {
            $account->user_id = $user->id;
        }

        $account->save(false);

        return $account;
    }

    /**
     * Tries to find an account and then connect that account with current user.
     *
     * @param BaseClientInterface $client
     */
    public static function connectWithUser(BaseClientInterface $client)
    {
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('danger', Yii::t('codexten:user', 'Something went wrong'));

            return;
        }

        $account = static::fetchAccount($client);

        if ($account->user === null) {
            $account->link('user', Yii::$app->user->identity);
            Yii::$app->session->setFlash('success', Yii::t('codexten:user', 'Your account has been connected'));
        } else {
            Yii::$app->session->setFlash(
                'danger',
                Yii::t('codexten:user', 'This account has already been connected to another user')
            );
        }
    }

    /**
     * Tries to find account, otherwise creates new account.
     *
     * @param BaseClientInterface $client
     *
     * @return Account
     * @throws InvalidConfigException
     */
    protected static function fetchAccount(BaseClientInterface $client)
    {
        $account = static::getFinder()->findAccount()->byClient($client)->one();

        if (null === $account) {
            $account = Yii::createObject([
                'class' => static::className(),
                'provider' => $client->getId(),
                'client_id' => $client->getUserAttributes()['id'],
                'data' => Json::encode($client->getUserAttributes()),
            ]);
            $account->save(false);
        }

        return $account;
    }

    /**
     * Tries to find user or create a new one.
     *
     * @param Account $account
     *
     * @return User|bool False when can't create user.
     */
    protected static function fetchUser(Account $account)
    {
        $user = static::getFinder()->findUserByEmail($account->email);

        if (null !== $user) {
            return $user;
        }

        $user = Yii::createObject([
            'class' => User::className(),
            'scenario' => 'connect',
            'username' => $account->username,
            'email' => $account->email,
        ]);

        if (!$user->validate(['email'])) {
            $account->email = null;
        }

        if (!$user->validate(['username'])) {
            $account->username = null;
        }

        return $user->create() ? $user : false;
    }

    /**
     * @return Finder
     */
    protected static function getFinder()
    {
        if (static::$finder === null) {
            static::$finder = Yii::$container->get(Finder::className());
        }

        return static::$finder;
    }
}
